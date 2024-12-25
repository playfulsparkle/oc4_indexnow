<?php
namespace Opencart\Catalog\Controller\Extension\PsIndexNow\Feed;

class PsIndexNow extends \Opencart\System\Engine\Controller
{
    public function index(): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }
    }
}
