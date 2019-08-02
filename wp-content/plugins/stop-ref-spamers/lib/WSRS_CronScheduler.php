<?php

class WSRS_CronScheduler 
{
    /**
     * @param mixed $request
     *
     * @return mixed
     */
    public function scheduleIfNotScheduled($request)
    {
        if (!$this->isCronEventScheduled()) {
            $this->scheduleEvent();
        }

        return $request;
    }

    /**
     * @return boolean
     */
    public function isCronEventScheduled()
    {
        return (false !== wp_get_schedule(WSRS_Config::WSRS_CRON_HOOK_NAME));
    }

    public function scheduleEvent() 
    {
        wp_schedule_event(time(), 'twicedaily', WSRS_Config::WSRS_CRON_HOOK_NAME);
    }
}