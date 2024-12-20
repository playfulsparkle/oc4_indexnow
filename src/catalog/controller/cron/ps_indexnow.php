<?php
namespace Opencart\Catalog\Controller\Extension\PsIndexNow\Ctron;

class PsIndexNow extends \Opencart\System\Engine\Controller
{
    /**
     * Index
     *
     * @param int    $cron_id
     * @param string $code
     * @param string $cycle
     * @param string $date_added
     * @param string $date_modified
     *
     * @return void
     */
    public function index(int $cron_id, string $code, string $cycle, string $date_added, string $date_modified): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }
    }
}
