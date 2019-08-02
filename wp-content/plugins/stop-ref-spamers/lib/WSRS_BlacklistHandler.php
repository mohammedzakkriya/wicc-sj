<?php


class WSRS_BlacklistHandler
{

    /**
     * @param bool $forceRefresh
     *
     * @return array
     */
    public function getBlacklistArray($forceRefresh = true)
    {
        $blacklistJson = get_option(WSRS_Config::WSRS_OPTION_BLACKLIST);
        if (false === $blacklistJson && true === $forceRefresh) {
            $this->refreshBlacklist();
            return $this->getBlacklistArray(false);
        }
        if (null === ($blacklist = json_decode($blacklistJson, true))) {
            return array();
        }

        $blacklist = array_merge($blacklist, $this->getCustomUrls());
        sort($blacklist);
        return array_values(array_unique($blacklist));
    }

    public function refreshBlacklist()
    {
        $blacklistRawResponse = wp_remote_get(WSRS_Config::WSRS_BLACKLIST_SOURCE);
        if ($blacklistRawResponse instanceof WP_Error) {
            error_log('Wordpress WSRS: error when getting blacklist: ' . $blacklistRawResponse->get_error_message());
            return;
        }
        $blacklistJson = $blacklistRawResponse['body'];
        if (empty($blacklistJson)) {
            error_log('Wordpress WSRS: default blacklist empty');
            return;
        }

        $decodedBlacklist = json_decode($blacklistJson, true);
        if (null === $decodedBlacklist) {
            error_log('Wordpress WSRS: downloaded blacklist is not a correct json');
            return;
        }

        $cachedBlacklistJson = get_option(WSRS_Config::WSRS_OPTION_BLACKLIST);
        if (false !== $cachedBlacklistJson && md5($blacklistJson) === md5($cachedBlacklistJson)) {
            return;
        }
        update_option(WSRS_Config::WSRS_OPTION_BLACKLIST, $blacklistJson, true);
    }

    /**
     * @return array
     */
    public function getCustomUrls()
    {
        $customUrls = get_option(WSRS_Config::WSRS_OPTION_CUSTOM_URLS);
        if (false !== $customUrls && "" !== trim($customUrls)) {
            $customUrlsArray = explode("\n", $customUrls);
            return array_map('trim', $customUrlsArray);
        }

        return array();
    }
}
