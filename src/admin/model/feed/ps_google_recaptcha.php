<?php
namespace Opencart\Admin\Model\Extension\PsIndexNow\Feed;
/**
 * Class PsIndexNow
 *
 * @package Opencart\Admin\Model\Extension\PsIndexNow\Feed
 */
class PsIndexNow extends \Opencart\System\Engine\Model
{
    public function replaceAdminViewCommonHeaderBefore(array $args): array
    {
        $views = [];

        $views[] = [
            'search' => '',
            'replace' => ''
        ];

        return $views;
    }
}
