<?php


class WSRS_ConfigurationPage
{
    /**
     * @var WSRS_BlacklistHandler
     */
    private $blacklistHandler;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var string
     */
    private static $noticeTpl = "<div class=\"updated notice\"><p>Hey! %s</p></div>";

    public function __construct()
    {
        $this->blacklistHandler = new WSRS_BlacklistHandler();
    }

    public function configurationPage()
    {
        $this->processParameters();
        $data = $this->data;
        $data['blacklist'] = $this->blacklistHandler->getBlacklistArray();
        $data['refresh_message'] = $this->displayUpdateNotice();
        $data['custom_urls'] = get_option(WSRS_Config::WSRS_OPTION_CUSTOM_URLS) !== false ? get_option(WSRS_Config::WSRS_OPTION_CUSTOM_URLS) : '';
        include_once(WSRS_ROOT_DIR."/views/config-page.php");
    }

    public function processParameters()
    {
        if (WSRS_Helper::get('force_refresh')) {
            $this->blacklistHandler->refreshBlacklist();
        }
        if (WSRS_Helper::is_post()) {
            if ($this->saveCustomUrls(WSRS_Helper::get_post())) {
                $this->data['save_message'] = $this->displaySaveNotice();
            }
        }
    }

    /**
     * @param array $postData
     *
     * @return bool
     */
    public function saveCustomUrls($postData)
    {
        $customUrls = trim($postData['custom_urls']);
        if (!empty($customUrls)) {
            $customUrlsArray = explode("\n", $customUrls);
            $customUrlsArray = array_filter(array_map(array($this, 'cleanUrlsBeforeSave'), $customUrlsArray));
            update_option(WSRS_Config::WSRS_OPTION_CUSTOM_URLS, implode("\n", $customUrlsArray), true);
            return true;
        }

        return false;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function cleanUrlsBeforeSave($url) {
        $url = trim($url);
        return strpos($url, 'http') === 0 ? parse_url($url, PHP_URL_HOST) : $url;
    }

    /**
     * @return string
     */
    public function displayUpdateNotice()
    {
        $message = "Blacklist is now up to date :)";
        return sprintf(self::$noticeTpl, $message);
    }

    /**
     * @return string
     */
    public function displaySaveNotice()
    {
        $message = "Custom URLs has been saved :)";
        return sprintf(self::$noticeTpl, $message);
    }
}