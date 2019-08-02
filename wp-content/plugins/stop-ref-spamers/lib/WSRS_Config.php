<?php


class WSRS_Config
{
    const WSRS_BLACKLIST_SOURCE_WEBSITE = 'https://github.com/piwik/referrer-spam-blacklist';
    const WSRS_BLACKLIST_SOURCE = 'http://wielo.co/referrer-spam.php';
    const WSRS_CRON_HOOK_NAME = 'wsrs_update_blacklist_twicedaily';
    const WSRS_OPTION_BLACKLIST = 'WSRS_spam_blacklist';
    const WSRS_OPTION_CUSTOM_URLS = 'WSRS_spam_custom_urls';
}