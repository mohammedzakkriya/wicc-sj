<?php


class WSRS_RequestHandler
{
    /**
     * @var WP_Query
     */
    private $wpQuery;

    /**
     * @var WSRS_BlacklistHandler
     */
    private $blacklist;

    public function __construct()
    {
        global $wp_query;

        $this->wpQuery = $wp_query;
        $this->blacklist = new WSRS_BlacklistHandler();
    }

    /**
     * @param mixed $request
     *
     * @return mixed
     */
    public function filterRequest($request)
    {
        if ($this->checkIfReferrerHostIsBlacklisted()) {
            $this->display404();
        }

        return $request;
    }

    /**
     * @return boolean
     */
    public function checkIfReferrerHostIsBlacklisted()
    {
        if (false === ($referrerHost = $this->getReferrerHost())) {
            return false;
        }
        $blacklist = $this->blacklist->getBlacklistArray();
        foreach ($blacklist as $blacklistedDomain) {
            if (false !== stripos($referrerHost, $blacklistedDomain)) {
                return true;
            }
        }

        return false;
    }

    public function display404($noTemplate = true)
    {
        status_header(404);
        if (!$noTemplate) {
            $this->wpQuery->set_404();
            get_template_part(404);
        }
        exit();
    }

    /**
     * @return string
     */
    private function getReferrerHost()
    {
        $referrer = $this->getReferrer();
        if (empty($referrer)) {
            return false;
        }

        return parse_url($referrer, PHP_URL_HOST);
    }

    /**
     * @return string
     */
    private function getReferrer()
    {
        return wp_get_referer() !== false ? wp_get_referer() : $_SERVER['HTTP_REFERER'];
    }
}