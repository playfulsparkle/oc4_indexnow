<?php
namespace Opencart\Admin\Model\Extension\PsIndexNow\Feed;
/**
 * Class PsIndexNow
 *
 * @package Opencart\Admin\Model\Extension\PsIndexNow\Feed
 */
class PsIndexNow extends \Opencart\System\Engine\Model
{
    public function install(): void
    {
        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "ps_google_base_category` (
				`google_base_category_id` INT(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) NOT NULL,
                PRIMARY KEY (`google_base_category_id`),
                KEY `name` (`name`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
    }

    public function uninstall(): void
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "ps_google_base_category_to_category`");
    }

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
