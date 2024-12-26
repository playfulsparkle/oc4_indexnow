<?php
namespace Opencart\Admin\Controller\Extension\PsIndexNow\Feed;
/**
 * Class PsIndexNow
 *
 * @package Opencart\Admin\Controller\Extension\PsIndexNow\Feed
 */
class PsIndexNow extends \Opencart\System\Engine\Controller
{
    /**
     * @var string The support email address.
     */
    const EXTENSION_EMAIL = 'support@playfulsparkle.com';

    /**
     * @var string The documentation URL for the extension.
     */
    const EXTENSION_DOC = 'https://github.com/playfulsparkle/oc4_indexnow.git';

    private $seo_url_values = [];

    /**
     * Displays the IndexNow settings page.
     *
     * This method loads the necessary language file, sets the title of the page,
     * and prepares the data for the view. It also generates the breadcrumbs for
     * navigation and retrieves configuration settings for the sitemap.
     *
     * @return void
     */
    public function index(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $this->load->model('setting/setting');
        $this->load->model('setting/store');
        $this->load->model('localisation/language');
        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');


        if (isset($this->request->get['store_id'])) {
            $store_id = (int) $this->request->get['store_id'];
        } else {
            $store_id = 0;
        }


        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=feed', true)
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/ps_indexnow/feed/ps_indexnow', 'user_token=' . $this->session->data['user_token'])
        ];

        $separator = version_compare(VERSION, '4.0.2.0', '>=') ? '.' : '|';

        $data['action'] = $this->url->link('extension/ps_indexnow/feed/ps_indexnow' . $separator . 'save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=feed');
        $data['fix_event_handler'] = $this->url->link('extension/ps_indexnow/feed/ps_indexnow' . $separator . 'fixEventHandler', 'user_token=' . $this->session->data['user_token']);

        $data['user_token'] = $this->session->data['user_token'];

        $data['oc4_separator'] = $separator;


        $config = $this->model_setting_setting->getSetting('feed_ps_indexnow', $store_id);

        $server = $this->get_store_url($store_id);

        $data['feed_ps_indexnow_status'] = isset($config['feed_ps_indexnow_status']) ? (bool) $config['feed_ps_indexnow_status'] : false;
        $data['feed_ps_indexnow_service_status'] = isset($config['feed_ps_indexnow_service_status']) ? (array) $config['feed_ps_indexnow_service_status'] : [];
        $data['feed_ps_indexnow_service_key'] = isset($config['feed_ps_indexnow_service_key']) ? $config['feed_ps_indexnow_service_key'] : '';
        $data['feed_ps_indexnow_service_key_location'] = isset($config['feed_ps_indexnow_service_key_location']) ? $config['feed_ps_indexnow_service_key_location'] : '';

        if ($data['feed_ps_indexnow_service_key_location']) {
            $data['feed_ps_indexnow_service_key_url'] = $server . $data['feed_ps_indexnow_service_key_location'];
        } else {
            $data['feed_ps_indexnow_service_key_url'] = '';
        }

        $data['feed_ps_indexnow_content_category'] = isset($config['feed_ps_indexnow_content_category']) ? (array) $config['feed_ps_indexnow_content_category'] : [];

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['store_id'] = $store_id;

        $data['stores'] = [];

        $data['stores'][] = [
            'store_id' => 0,
            'name' => $this->config->get('config_name') . '&nbsp;' . $this->language->get('text_default'),
            'href' => $this->url->link('extension/ps_indexnow/feed/ps_indexnow', 'user_token=' . $this->session->data['user_token'] . '&store_id=0'),
        ];

        $stores = $this->model_setting_store->getStores();

        foreach ($stores as $store) {
            $data['stores'][] = [
                'store_id' => $store['store_id'],
                'name' => $store['name'],
                'href' => $this->url->link('extension/ps_indexnow/feed/ps_indexnow', 'user_token=' . $this->session->data['user_token'] . '&store_id=' . $store['store_id']),
            ];
        }

        $data['server'] = $server;

        $data['cron_url'] = HTTP_CATALOG . 'index.php?route=extension/ps_indexnow/feed/ps_indexnow';

        $data['help_cron_url'] = sprintf($this->language->get('help_cron_url'), $this->url->link('marketplace/cron', 'user_token=' . $this->session->data['user_token']));

        $data['indexnow_services'] = $this->model_extension_ps_indexnow_feed_ps_indexnow->getIndexNowServiceList();

        $content_categories = [
            'category' => $this->language->get('text_categories'),
            'product' => $this->language->get('text_products'),
            'manufacturer' => $this->language->get('text_manufacturers'),
            'information' => $this->language->get('text_information'),
        ];

        if (version_compare(VERSION, '4.1.0.0', '>=')) {
            $content_categories = array_merge($content_categories, [
                'topic' => $this->language->get('text_topics'),
                'article' => $this->language->get('text_articles'),
            ]);
        }

        $data['content_categories'] = $content_categories;

        $data['text_contact'] = sprintf($this->language->get('text_contact'), self::EXTENSION_EMAIL, self::EXTENSION_EMAIL, self::EXTENSION_DOC);

        $data['text_url_list_warning'] = sprintf($this->language->get('text_url_list_warning'), parse_url($server, PHP_URL_HOST));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/ps_indexnow/feed/ps_indexnow', $data));
    }

    /**
     * Saves the settings for the IndexNow.
     *
     * This method validates user permissions, processes the submitted form data,
     * and saves the settings to the database. It returns a JSON response indicating
     * success or failure.
     *
     * @return void
     */
    public function save(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json && !isset($this->request->post['store_id'])) {
            $json['error'] = $this->language->get('error_store_id');
        }

        if (!$json) {
            $required_keys = ['feed_ps_indexnow_service_key'];

            foreach ($required_keys as $value) {
                if (!isset($this->request->post[$value])) {
                    $this->request->post[$value] = '';
                }
            }

            if (empty($this->request->post['feed_ps_indexnow_service_key'])) {
                $json['error']['input-service-key'] = $this->language->get('error_service_key');
            }
        }

        if (!$json) {
            $this->load->model('setting/setting');

            $this->model_setting_setting->editSetting('feed_ps_indexnow', $this->request->post, $this->request->post['store_id']);

            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    /**
     * Installs the IndexNow extension.
     *
     * This method will contain logic to set up the necessary configurations or
     * database tables needed for the extension upon installation. Currently, it is empty.
     *
     * @return void
     */
    public function install(): void
    {
        if ($this->user->hasPermission('modify', 'extension/feed')) {
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            $stores = array_merge([0], array_column($this->model_setting_store->getStores(), 'store_id'));

            foreach ($stores as $store_id) {
                $service_key = $this->save_service_key();

                $data = [
                    'feed_ps_indexnow_service_key' => $service_key,
                    'feed_ps_indexnow_service_key_location' => $service_key . '.txt',
                ];

                $this->model_setting_setting->editSetting('feed_ps_indexnow', $data, $store_id);
            }

            $this->load->model('setting/event');

            $this->_registerEvents();

            $this->load->model('setting/cron');

            $this->model_setting_cron->addCron('ps_indexnow', 'IndexNow Cron Job', 'day', 'extension/ps_indexnow/cron/ps_indexnow', true);

            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

            $this->model_extension_ps_indexnow_feed_ps_indexnow->install();
        }
    }

    /**
     * Uninstalls the IndexNow extension.
     *
     * This method will contain logic to remove configurations or database tables
     * created by the extension upon uninstallation. Currently, it is empty.
     *
     * @return void
     */
    public function uninstall(): void
    {
        if ($this->user->hasPermission('modify', 'extension/feed')) {
            $this->load->model('setting/event');

            $this->_unregisterEvents();

            $this->load->model('setting/cron');

            $this->model_setting_cron->deleteCronByCode('ps_indexnow');

            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

            $this->model_extension_ps_indexnow_feed_ps_indexnow->uninstall();
        }
    }

    public function generate_service_key(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            if (isset($this->request->get['store_id'])) {
                $store_id = (int) $this->request->get['store_id'];
            } else {
                $store_id = 0;
            }

            $service_key = $this->save_service_key();

            if ($service_key) {
                $server = $this->get_store_url($store_id);

                $this->model_setting_setting->editValue('feed_ps_indexnow', 'feed_ps_indexnow_service_key', $service_key, $store_id);
                $this->model_setting_setting->editValue('feed_ps_indexnow', 'feed_ps_indexnow_service_key_location', $service_key . '.txt', $store_id);

                $json['service_key'] = $service_key;
                $json['service_key_location'] = $service_key . '.txt';
                $json['service_key_url'] = $server . $service_key . '.txt';

                $json['success'] = $this->language->get('text_success_generate_service_key');
            } else {
                $json['error'] = $this->language->get('error_generate_service_key');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function load_sitemap()
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('setting/store');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (isset($this->request->get['store_id'])) {
            $store_id = (int) $this->request->get['store_id'];
        } else {
            $store_id = 0;
        }

        if (!$json) {
            if (isset($this->request->files['file'])) {
                $json = $this->load_uploaded_sitemap($this->request->files['file']);
            } else if (isset($this->request->post['file'])) {
                $json = $this->load_url_sitemap($store_id, (string) $this->request->post['file']);
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    private function load_uploaded_sitemap(array $file_upload): array
    {
        $json = [];

        if (!empty($file_upload['name']) && is_file($file_upload['tmp_name'])) {
            $filename = basename($file_upload['name']);

            if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'xml') {
                $json['error'] = $this->language->get('error_filetype');

                return $json;
            }

            if (!in_array($file_upload['type'], ['text/xml', 'application/xml'], true)) {
                $json['error'] = $this->language->get('error_filetype');

                return $json;
            }

            if ((int) $file_upload['error'] !== UPLOAD_ERR_OK) {
                $json['error'] = $this->language->get('error_upload_' . $file_upload['error']);

                return $json;
            }
        } else {
            $json['error'] = $this->language->get('error_upload');

            return $json;
        }

        if (is_readable($file_upload['tmp_name'])) {
            $contents = file_get_contents($file_upload['tmp_name']);

            $json['url_list'] = $this->process_xml_sitemap($contents);

            @unlink($file_upload['tmp_name']);
        } else {
            $json['error'] = $this->language->get('error_upload');
        }

        return $json;
    }

    private function load_url_sitemap(int $store_id, string $file_url): array
    {
        $json = [];

        if (!filter_var($file_url, FILTER_VALIDATE_URL)) {
            $json['error'] = $this->language->get('error_invalid_url');

            return $json;
        }

        $file_host = parse_url($file_url, PHP_URL_HOST);

        $server = $this->get_store_url($store_id);
        $server_host = parse_url($server, PHP_URL_HOST);

        if ($file_host !== $server_host) {
            $json['error'] = $this->language->get('error_invalid_url_host');

            return $json;
        }

        $url_list = [];

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $file_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

            $response = curl_exec($ch);
            $error = curl_errno($ch);
            $http_status_code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($response !== false && !$error && in_array((int) $http_status_code, [200, 304])) {
                $url_list = $this->process_xml_sitemap($response);
            }
        } else if (ini_get('allow_url_fopen')) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'follow_location' => 1,
                    'max_redirects' => 1,
                    'ignore_errors' => true,
                ]
            ]);
            $response = @file_get_contents($file_url, false, $context);

            if ($response !== false) {
                $metadata = stream_get_meta_data($context);

                if (
                    isset($metadata['wrapper_data']) &&
                    preg_match('#HTTP/\d\.\d (\d+)#', $metadata['wrapper_data'][0], $matches) &&
                    in_array((int) $matches[1], [200, 304])
                ) {
                    $url_list = $this->process_xml_sitemap($response);
                }
            }
        }

        if ($url_list) {
            $json['url_list'] = $url_list;
        } else {
            $json['error'] = sprintf($this->language->get('error_download'), htmlspecialchars($file_url, ENT_QUOTES, 'UTF-8'));
        }

        return $json;
    }

    private function process_xml_sitemap(string $xmlString): string
    {
        if (empty($xmlString)) {
            return '';
        }

        libxml_use_internal_errors(true);

        $reader = new \XMLReader();

        if (!$reader->xml($xmlString)) {
            libxml_clear_errors();

            return '';
        }

        $urls = [];

        while ($reader->read()) {
            if ($reader->nodeType === \XMLReader::ELEMENT && $reader->localName === 'url') {
                try {
                    $node = new \SimpleXMLElement($reader->readOuterXML());

                    if (isset($node->loc)) {
                        $urls[] = (string) $node->loc;
                    }
                } catch (\Exception $e) {

                }
            }
        }

        $reader->close();

        return implode(PHP_EOL, $urls);
    }

    public function remove_queue()
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (isset($this->request->post['queue_id'])) {
            $queue_id = (int) $this->request->post['queue_id'];
        } else {
            $queue_id = 0;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

        if ($this->model_extension_ps_indexnow_feed_ps_indexnow->removeQueue($queue_id)) {
            $json['success'] = $this->language->get('text_success_remove_queue');
        } else {
            $json['error'] = $this->language->get('error_remove_queue');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function queue(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        if (isset($this->request->get['store_id'])) {
            $store_id = (int) $this->request->get['store_id'];
        } else {
            $store_id = 0;
        }

        if (isset($this->request->get['page'])) {
            $page = (int) $this->request->get['page'];
        } else {
            $page = 1;
        }

        $limit = 10;

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

        $filter_data = [
            'store_id' => $store_id,
            'start' => ($page - 1) * $limit,
            'limit' => $limit
        ];

        $results = $this->model_extension_ps_indexnow_feed_ps_indexnow->getQueue($filter_data);

        $data['indexnow_queues'] = [];

        foreach ($results as $result) {
            $data['indexnow_queues'][] = [
                'queue_id' => $result['queue_id'],
                'url' => $result['url'],
                'date_added' => date($this->language->get('datetime_format'), strtotime($result['date_added']))
            ];
        }

        $queue_total = $this->model_extension_ps_indexnow_feed_ps_indexnow->getTotalQueue($store_id);

        $separator = version_compare(VERSION, '4.0.2.0', '>=') ? '.' : '|';

        $data['pagination'] = $this->load->controller('common/pagination', [
            'total' => $queue_total,
            'page' => $page,
            'limit' => $limit,
            'url' => $this->url->link('extension/ps_indexnow/feed/ps_indexnow' . $separator . 'queue', 'store_id= ' . $store_id . '&user_token=' . $this->session->data['user_token'] . '&page={page}')
        ]);

        $data['results'] = sprintf($this->language->get('text_pagination'), ($queue_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($queue_total - 10)) ? $queue_total : ((($page - 1) * 10) + 10), $queue_total, ceil($queue_total / 10));

        $this->response->setOutput($this->load->view('extension/ps_indexnow/feed/ps_indexnow_queue', $data));
    }

    public function submit_queue(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }


        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('setting/setting');
        $this->load->model('setting/store');


        if (isset($this->request->get['store_id'])) {
            $store_id = (int) $this->request->get['store_id'];
        } else {
            $store_id = 0;
        }

        if (isset($this->request->post['queue_id'])) {
            $queue_id = (int) $this->request->post['queue_id'];
        } else {
            $queue_id = 0;
        }

        $server = $this->get_store_url($store_id);
        $server_host = parse_url($server, PHP_URL_HOST);

        if (!$json) {
            if (isset($this->request->post['url_list'])) {
                $url_list = array_map('trim', explode("\n", (string) $this->request->post['url_list']));

                $url_list = array_filter($url_list, function ($url) use ($server_host) {
                    if (!filter_var($url, FILTER_VALIDATE_URL)) {
                        return false;
                    }

                    $url_host = parse_url($url, PHP_URL_HOST);

                    return $url_host && strcasecmp($url_host, $server_host) === 0;
                });

                if (empty($url_list)) {
                    $json['error'] = $this->language->get('error_submit_url_list_invalid');
                }

                $queue_id_list = [];
            } else {
                $filter_data = [
                    'store_id' => $store_id,
                    'queue_id' => $queue_id,
                    'order' => 'ASC',
                ];

                $result = $this->model_extension_ps_indexnow_feed_ps_indexnow->getQueue($filter_data);

                $url_list = $result ? array_column($result, 'url') : [];
                $queue_id_list = $result ? array_column($result, 'queue_id') : [];

                if (empty($url_list)) {
                    $json['error'] = $this->language->get('error_empty_queue');
                }
            }
        }

        if (!$json) {
            $config = $this->model_setting_setting->getSetting('feed_ps_indexnow', $store_id);

            if (isset($config['feed_ps_indexnow_service_status'])) {
                $services = $this->model_extension_ps_indexnow_feed_ps_indexnow->getServiceEndpoints((array) $config['feed_ps_indexnow_service_status']);
            } else {
                $services = [];
            }

            $service_key = isset($config['feed_ps_indexnow_service_key']) ? $config['feed_ps_indexnow_service_key'] : '';
            $service_key_location = isset($config['feed_ps_indexnow_service_key_location']) ? $config['feed_ps_indexnow_service_key_location'] : '';

            if (!$services) {
                $json['error'] = $this->language->get('error_no_services_enabled');
            }
        }

        if (!$json) {
            $all_success = true;

            foreach ($services as $service) {
                $batches = array_chunk($url_list, 10000);

                foreach ($batches as $batch) {
                    $status_code = $this->submitUrls(
                        $service['endpoint_url'],
                        $server_host,
                        $service_key,
                        $server . $service_key_location,
                        $batch
                    );

                    $log_data = [];

                    foreach ($batch as $batch_url) {
                        $log_data[] = [
                            'service_id' => $service['service_id'],
                            'url' => $batch_url,
                            'status_code' => (int) $status_code,
                            'store_id' => $store_id,
                        ];
                    }

                    if ($all_success && $status_code !== 200) {
                        $all_success = false;
                    }

                    $this->model_extension_ps_indexnow_feed_ps_indexnow->addLog($log_data);

                    sleep(1);
                }
            }

            if ($services && $queue_id_list) {
                $this->model_extension_ps_indexnow_feed_ps_indexnow->removeQueueItems($queue_id_list);
            }

            if ($all_success) {
                $json['success'] = !$queue_id_list ? $this->language->get('text_success_submit_url_list') : $this->language->get('text_success_submit_queue');
            } else {
                $json['error'] = !$queue_id_list ? $this->language->get('error_submit_url_list') : $this->language->get('error_submit_queue');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function clear_queue(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

            if (isset($this->request->get['store_id'])) {
                $store_id = (int) $this->request->get['store_id'];
            } else {
                $store_id = 0;
            }

            if ($this->model_extension_ps_indexnow_feed_ps_indexnow->clearQueue($store_id)) {
                $json['success'] = $this->language->get('text_success_clear_queue');
            } else {
                $json['error'] = $this->language->get('error_clear_queue');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function log(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        if (isset($this->request->get['store_id'])) {
            $store_id = (int) $this->request->get['store_id'];
        } else {
            $store_id = 0;
        }

        if (isset($this->request->get['page'])) {
            $page = (int) $this->request->get['page'];
        } else {
            $page = 1;
        }

        $limit = 10;

        $filter_data = [
            'store_id' => $store_id,
            'start' => ($page - 1) * $limit,
            'limit' => $limit
        ];

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

        $results = $this->model_extension_ps_indexnow_feed_ps_indexnow->getLog($filter_data);

        $data['indexnow_logs'] = [];

        foreach ($results as $result) {
            $data['indexnow_logs'][] = [
                'log_id' => $result['log_id'],
                'service_name' => $result['service_name'],
                'url' => $result['url'],
                'status_code' => $result['status_code'],
                'date_added' => date($this->language->get('datetime_format'), strtotime($result['date_added']))
            ];
        }

        $log_total = $this->model_extension_ps_indexnow_feed_ps_indexnow->getTotalLog($store_id);

        $separator = version_compare(VERSION, '4.0.2.0', '>=') ? '.' : '|';

        $data['pagination'] = $this->load->controller('common/pagination', [
            'total' => $log_total,
            'page' => $page,
            'limit' => $limit,
            'url' => $this->url->link('extension/ps_indexnow/feed/ps_indexnow' . $separator . 'log', 'store_id= ' . $store_id . '&user_token=' . $this->session->data['user_token'] . '&page={page}')
        ]);

        $data['results'] = sprintf($this->language->get('text_pagination'), ($log_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($log_total - 10)) ? $log_total : ((($page - 1) * 10) + 10), $log_total, ceil($log_total / 10));

        $this->response->setOutput($this->load->view('extension/ps_indexnow/feed/ps_indexnow_log', $data));
    }

    public function clear_log(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');

            if (isset($this->request->get['store_id'])) {
                $store_id = (int) $this->request->get['store_id'];
            } else {
                $store_id = 0;
            }

            if ($this->model_extension_ps_indexnow_feed_ps_indexnow->clearLog($store_id)) {
                $json['success'] = $this->language->get('text_success_clear_log');
            } else {
                $json['error'] = $this->language->get('error_clear_log');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    private function submitUrls($service_endpoint, $host, $service_key, $service_key_location, $url_list)
    {
        $post_data = json_encode([
            'host' => $host,
            'key' => $service_key,
            'keyLocation' => $service_key_location,
            'urlList' => $url_list,
        ]);

        $headers = [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($post_data)
        ];

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $service_endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $response = curl_exec($ch);

            if ($response !== false && !curl_errno($ch)) {
                $status_code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            } else {
                $status_code = false;
            }

            curl_close($ch);

            return $status_code;
        } else if (ini_get('allow_url_fopen')) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'ignore_errors' => true,
                    'header' => $headers,
                    'method' => 'POST',
                    'content' => $post_data
                ]
            ]);

            $response = @file_get_contents($service_endpoint, false, $context);

            if ($response !== false) {
                $metadata = stream_get_meta_data($context);

                if (isset($metadata['wrapper_data']) && preg_match('#HTTP/\d\.\d (\d+)#', $metadata['wrapper_data'][0], $matches)) {
                    return (int) $matches[1];
                }
            }
        }

        return false;
    }

    private function get_store_url($store_id)
    {
        $server = HTTP_CATALOG;

        if ($store_id > 0 && $store = $this->model_setting_store->getStore($store_id)) {
            $server = $store['url'];
        }

        return $server;
    }

    private function save_service_key()
    {
        if (!is_writable(DIR_OPENCART)) {
            return false;
        }

        try {
            $service_key = $this->generateServiceKey();

            $filename = DIR_OPENCART . $service_key . '.txt';

            $handle = fopen($filename, 'w');

            if ($handle) {
                fwrite($handle, $service_key);

                fclose($handle);

                return $service_key;
            }
        } catch (\Exception $th) {
            return false;
        }
    }

    private function generateServiceKey(): string
    {
        $length = 32;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-';
        $charactersLength = strlen($characters);
        $randomKey = '';

        // Preferred: Use random_bytes for secure key generation
        if (function_exists('random_bytes')) {
            try {
                $bytes = random_bytes($length);

                for ($i = 0; $i < $length; $i++) {
                    $randomKey .= $characters[ord($bytes[$i]) % $charactersLength];
                }

                return $randomKey;
            } catch (Exception $e) {
                // Fallback to the next method
            }
        }

        // Fallback: Use openssl_random_pseudo_bytes if random_bytes is unavailable
        if (function_exists('openssl_random_pseudo_bytes')) {
            try {
                $bytes = openssl_random_pseudo_bytes($length);

                for ($i = 0; $i < $length; $i++) {
                    $randomKey .= $characters[ord($bytes[$i]) % $charactersLength];
                }

                return $randomKey;
            } catch (Exception $e) {
                // Fallback to the next method
            }
        }

        // Fallback: Use random_int for cryptographic randomness
        if (function_exists('random_int')) {
            for ($i = 0; $i < $length; $i++) {
                $randomKey .= $characters[random_int(0, $charactersLength - 1)];
            }

            return $randomKey;
        }

        // Last Resort: Use mt_rand (not cryptographically secure)
        for ($i = 0; $i < $length; $i++) {
            $randomKey .= $characters[mt_rand(0, $charactersLength - 1)];
        }

        return $randomKey;
    }

    public function fixEventHandler(): void
    {
        $this->load->language('extension/ps_indexnow/feed/ps_indexnow');

        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/ps_indexnow/feed/ps_indexnow')) {
            $json['error'] = $this->language->get('error_permission');
        }

        if (!$json) {
            $this->load->model('setting/event');

            $this->_unregisterEvents();

            if ($this->_registerEvents() > 0) {
                $json['success'] = $this->language->get('text_success');
            } else {
                $json['error'] = $this->language->get('error_event');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    private function _unregisterEvents(): void
    {
        $this->model_setting_event->deleteEventByCode('feed_ps_indexnow');
    }

    private function _registerEvents(): int
    {
        $separator = version_compare(VERSION, '4.0.2.0', '>=') ? '.' : '|';

        $events = [
            ['trigger' => 'admin/controller/catalog/category' . $separator . 'save/after', 'description' => '', 'actionName' => 'eventAdminControllerCatalogCategorySaveAfter'],
            ['trigger' => 'admin/controller/catalog/category' . $separator . 'delete/before', 'description' => '', 'actionName' => 'eventAdminControllerCatalogCategoryDeleteBefore'],

            ['trigger' => 'admin/controller/catalog/product' . $separator . 'save/after', 'description' => '', 'actionName' => 'eventAdminControllerCatalogProductSaveAfter'],
            ['trigger' => 'admin/controller/catalog/product' . $separator . 'delete/before', 'description' => '', 'actionName' => 'eventAdminControllerCatalogProductDeleteBefore'],

            ['trigger' => 'admin/controller/catalog/manufacturer' . $separator . 'save/after', 'description' => '', 'actionName' => 'eventAdminControllerCatalogManufacturerSaveAfter'],
            ['trigger' => 'admin/controller/catalog/manufacturer' . $separator . 'delete/before', 'description' => '', 'actionName' => 'eventAdminControllerCatalogManufacturerDeleteBefore'],

            ['trigger' => 'admin/controller/catalog/information' . $separator . 'save/after', 'description' => '', 'actionName' => 'eventAdminControllerCatalogInformationSaveAfter'],
            ['trigger' => 'admin/controller/catalog/information' . $separator . 'delete/before', 'description' => '', 'actionName' => 'eventAdminControllerCatalogInformationDeleteBefore'],
        ];

        if (version_compare(VERSION, '4.1.0.0', '>=')) {
            $events = array_merge($events, [
                ['trigger' => 'admin/controller/cms/topic' . $separator . 'save/after', 'description' => '', 'actionName' => 'eventAdminControllerCmsTopicSaveAfter'],
                ['trigger' => 'admin/controller/cms/topic' . $separator . 'delete/before', 'description' => '', 'actionName' => 'eventAdminControllerCmsTopicDeleteBefore'],

                ['trigger' => 'admin/controller/cms/article' . $separator . 'save/after', 'description' => '', 'actionName' => 'eventAdminControllerCmsArticleSaveAfter'],
                ['trigger' => 'admin/controller/cms/article' . $separator . 'delete/before', 'description' => '', 'actionName' => 'eventAdminControllerCmsArticleDeleteBefore'],
            ]);
        }

        $result = 0;

        if (version_compare(VERSION, '4.0.1.0', '>=')) {
            foreach ($events as $event) {
                $result += $this->model_setting_event->addEvent([
                    'code' => 'feed_ps_indexnow',
                    'description' => $event['description'],
                    'trigger' => $event['trigger'],
                    'action' => 'extension/ps_indexnow/feed/ps_indexnow' . $separator . $event['actionName'],
                    'status' => '1',
                    'sort_order' => '0'
                ]);
            }
        } else {
            foreach ($events as $event) {
                $result += $this->model_setting_event->addEvent(
                    'feed_ps_indexnow',
                    $event['description'],
                    $event['trigger'],
                    'extension/ps_indexnow/feed/ps_indexnow' . $separator . $event['actionName']
                );
            }
        }

        return $result > 0;
    }

    #region Category
    public function eventAdminControllerCatalogCategorySaveAfter(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $json = json_decode($this->response->getOutput(), true);

        if (isset($json['success'])) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
            $this->load->model('localisation/language');
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            $languages = $this->model_localisation_language->getLanguages();

            $category_store = (array) $this->request->post['category_store'];
            $post_data = $this->request->post;

            unset($post_data['category_store']);

            $content_hash = md5(json_encode($post_data));

            if (isset($json['category_id'])) {
                $this->addToQueueItemData('category', 'index.php?route=product/category&language=%s&path=' . (int) $json['category_id'], $category_store, $content_hash, $languages);
            } else if (isset($this->request->post['category_id'])) {
                $this->addToQueueItemData('category', 'index.php?route=product/category&language=%s&path=' . (int) $this->request->post['category_id'], $category_store, $content_hash, $languages);
            }
        }
    }

    public function eventAdminControllerCatalogCategoryDeleteBefore(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('localisation/language');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $item_stores = array_merge([0 => HTTP_CATALOG], $this->model_setting_store->getStores());
        $languages = $this->model_localisation_language->getLanguages();
        $content_hash = md5(json_encode($this->request->post));

        foreach ((array) $this->request->post['selected'] as $category_id) {
            $this->addToQueueItemData('category', 'index.php?route=product/category&language=%s&path=' . (int) $category_id, $item_stores, $content_hash, $languages);
        }
    }
    #endregion

    #region Product
    public function eventAdminControllerCatalogProductSaveAfter(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $json = json_decode($this->response->getOutput(), true);

        if (isset($json['success'])) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
            $this->load->model('localisation/language');
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            $languages = $this->model_localisation_language->getLanguages();

            $product_store = (array) $this->request->post['product_store'];
            $post_data = $this->request->post;

            unset($post_data['product_store']);

            $content_hash = md5(json_encode($post_data));

            if (isset($json['product_id'])) {
                $this->addToQueueItemData('product', 'index.php?route=product/product&language=%s&product_id=' . (int) $json['product_id'], $product_store, $content_hash, $languages);
            } else if (isset($this->request->post['product_id'])) {
                $this->addToQueueItemData('product', 'index.php?route=product/product&language=%s&product_id=' . (int) $this->request->post['product_id'], $product_store, $content_hash, $languages);
            }
        }
    }

    public function eventAdminControllerCatalogProductDeleteBefore(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('localisation/language');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $item_stores = array_merge([0 => HTTP_CATALOG], $this->model_setting_store->getStores());
        $languages = $this->model_localisation_language->getLanguages();
        $content_hash = md5(json_encode($this->request->post));

        foreach ((array) $this->request->post['selected'] as $product_id) {
            $this->addToQueueItemData('product', 'index.php?route=product/product&language=%s&product_id=' . (int) $product_id, $item_stores, $content_hash, $languages);
        }
    }
    #endregion

    #region Manufacturer
    public function eventAdminControllerCatalogManufacturerSaveAfter(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $json = json_decode($this->response->getOutput(), true);

        if (isset($json['success'])) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
            $this->load->model('localisation/language');
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            $languages = $this->model_localisation_language->getLanguages();

            $manufacturer_store = (array) $this->request->post['manufacturer_store'];
            $post_data = $this->request->post;

            unset($post_data['manufacturer_store']);

            $content_hash = md5(json_encode($post_data));

            $separator = version_compare(VERSION, '4.0.2.0', '>=') ? '.' : '|';

            if (isset($json['manufacturer_id'])) {
                $this->addToQueueItemData('manufacturer', 'index.php?route=product/manufacturer' . $separator . 'info&language=%s&manufacturer_id=' . (int) $json['manufacturer_id'], $manufacturer_store, $content_hash, $languages);
            } else if (isset($this->request->post['manufacturer_id'])) {
                $this->addToQueueItemData('manufacturer', 'index.php?route=product/manufacturer' . $separator . 'info&language=%s&manufacturer_id=' . (int) $this->request->post['manufacturer_id'], $manufacturer_store, $content_hash, $languages);
            }
        }
    }

    public function eventAdminControllerCatalogManufacturerDeleteBefore(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('localisation/language');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $item_stores = array_merge([0 => HTTP_CATALOG], $this->model_setting_store->getStores());
        $languages = $this->model_localisation_language->getLanguages();
        $content_hash = md5(json_encode($this->request->post));

        $separator = version_compare(VERSION, '4.0.2.0', '>=') ? '.' : '|';

        foreach ((array) $this->request->post['selected'] as $manufacturer_id) {
            $this->addToQueueItemData('manufacturer', 'index.php?route=product/manufacturer' . $separator . 'info&language=%s&manufacturer_id=' . (int) $manufacturer_id, $item_stores, $content_hash, $languages);
        }
    }
    #endregion

    #region Information
    public function eventAdminControllerCatalogInformationSaveAfter(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $json = json_decode($this->response->getOutput(), true);

        if (isset($json['success'])) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
            $this->load->model('localisation/language');
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            $languages = $this->model_localisation_language->getLanguages();

            $information_store = (array) $this->request->post['information_store'];
            $post_data = $this->request->post;

            unset($post_data['information_store']);

            $content_hash = md5(json_encode($post_data));

            if (isset($json['information_id'])) {
                $this->addToQueueItemData('information', 'index.php?route=information/information&language=%s&information_id=' . (int) $json['information_id'], $information_store, $content_hash, $languages);
            } else if (isset($this->request->post['information_id'])) {
                $this->addToQueueItemData('information', 'index.php?route=information/information&language=%s&information_id=' . (int) $this->request->post['information_id'], $information_store, $content_hash, $languages);
            }
        }
    }

    public function eventAdminControllerCatalogInformationDeleteBefore(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('localisation/language');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $item_stores = array_merge([0 => HTTP_CATALOG], $this->model_setting_store->getStores());
        $languages = $this->model_localisation_language->getLanguages();
        $content_hash = md5(json_encode($this->request->post));

        foreach ((array) $this->request->post['selected'] as $information_id) {
            $this->addToQueueItemData('information', 'index.php?route=information/information&language=%s&information_id=' . (int) $information_id, $item_stores, $content_hash, $languages);
        }
    }
    #endregion

    #region Topic
    public function eventAdminControllerCmsTopicSaveAfter(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $json = json_decode($this->response->getOutput(), true);

        if (isset($json['success'])) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
            $this->load->model('localisation/language');
            $this->load->model('setting/store');
            $this->load->model('setting/setting');

            $languages = $this->model_localisation_language->getLanguages();

            $topic_store = (array) $this->request->post['topic_store'];
            $post_data = $this->request->post;

            unset($post_data['topic_store']);

            $content_hash = md5(json_encode($post_data));

            if (isset($json['topic_id'])) {
                $this->addToQueueItemData('topic', 'index.php?route=cms/blog&language=%s&topic_id=' . (int) $json['topic_id'], $topic_store, $content_hash, $languages);
            } else if (isset($this->request->post['topic_id'])) {
                $this->addToQueueItemData('topic', 'index.php?route=cms/blog&language=%s&topic_id=' . (int) $this->request->post['topic_id'], $topic_store, $content_hash, $languages);
            }
        }
    }

    public function eventAdminControllerCmsTopicDeleteBefore(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('localisation/language');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');

        $item_stores = array_merge([0 => HTTP_CATALOG], $this->model_setting_store->getStores());
        $languages = $this->model_localisation_language->getLanguages();
        $content_hash = md5(json_encode($this->request->post));

        foreach ((array) $this->request->post['selected'] as $topic_id) {
            $this->addToQueueItemData('topic', 'index.php?route=cms/blog&language=%s&topic_id=' . (int) $topic_id, $item_stores, $content_hash, $languages);
        }
    }
    #endregion

    #region Article
    public function eventAdminControllerCmsArticleSaveAfter(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $json = json_decode($this->response->getOutput(), true);

        if (isset($json['success'])) {
            $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
            $this->load->model('localisation/language');
            $this->load->model('setting/store');
            $this->load->model('setting/setting');
            $this->load->model('cms/article');

            $languages = $this->model_localisation_language->getLanguages();

            $article_store = (array) $this->request->post['article_store'];
            $post_data = $this->request->post;

            unset($post_data['article_store']);

            $content_hash = md5(json_encode($post_data));

            if (isset($json['article_id'])) {
                $article_info = $this->model_cms_article->getArticle((int) $json['article_id']);

                $this->addToQueueItemData('article', 'index.php?route=cms/blog.info&language=%s&article_id=' . (int) $json['article_id'] . '&topic_id=' . $article_info['topic_id'], $article_store, $content_hash, $languages);
            } else if (isset($this->request->post['article_id'])) {
                $article_info = $this->model_cms_article->getArticle((int) $this->request->post['article_id']);

                $this->addToQueueItemData('article', 'index.php?route=cms/blog.info&language=%s&article_id=' . (int) $this->request->post['article_id'] . '&topic_id=' . $article_info['topic_id'], $article_store, $content_hash, $languages);
            }
        }
    }

    public function eventAdminControllerCmsArticleDeleteBefore(string &$route, array &$args): void
    {
        if (!$this->config->get('feed_ps_indexnow_status')) {
            return;
        }

        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('localisation/language');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');
        $this->load->model('cms/article');

        $item_stores = array_merge([0 => HTTP_CATALOG], $this->model_setting_store->getStores());
        $languages = $this->model_localisation_language->getLanguages();
        $content_hash = md5(json_encode($this->request->post));

        foreach ((array) $this->request->post['selected'] as $article_id) {
            $article_info = $this->model_cms_article->getArticle($article_id);

            $this->addToQueueItemData('article', 'index.php?route=cms/blog.info&language=%s&article_id=' . (int) $article_id . '&topic_id=' . $article_info['topic_id'], $item_stores, $content_hash, $languages);
        }
    }
    #endregion

    private function addToQueueItemData(string $item_category, string $item_link, array $item_stores, string $content_hash, array $languages): void
    {
        $stores = [];

        foreach ($item_stores as $store_info) {
            if (is_array($store_info)) {
                $stores[$store_info['store_id']] = $store_info['url'];
            } else if (is_numeric($store_info)) {
                $store_id = (int) $store_info;

                if ($store_id === 0) {
                    $stores[$store_id] = HTTP_CATALOG;
                } else if ($store_data = $this->model_setting_store->getStore($store_id)) {
                    $stores[$store_id] = $store_data['url'];
                }
            }
        }

        if (!$stores) {
            return;
        }

        foreach ($stores as $store_id => $store_url) {
            $config = $this->model_setting_setting->getSetting('feed_ps_indexnow', $store_id);

            if (!isset($config['feed_ps_indexnow_status'], $config['feed_ps_indexnow_content_category'])) {
                continue;
            }

            if ((bool) $config['feed_ps_indexnow_status'] === false) {
                continue;
            }

            if (!in_array($item_category, (array) $config['feed_ps_indexnow_content_category'])) {
                continue;
            }

            foreach ($languages as $language) {
                $url = $store_url . sprintf($item_link, $language['code']);

                if ($this->config->get('config_seo_url')) {
                    $url = $this->rewrite($url, $store_id, $language['language_id']);
                }

                $data = [
                    'url' => $url,
                    'content_hash' => $content_hash,
                    'store_id' => $store_id,
                    'language_id' => $language['language_id'],
                ];

                $this->model_extension_ps_indexnow_feed_ps_indexnow->addQueue($data);
            }
        }
    }

    private function rewrite($link, $store_id, $language_id)
    {
        $url_info = parse_url($link);

        // Build the url
        $url = '';

        if (isset($url_info['scheme'])) {
            $url .= $url_info['scheme'];
        }

        $url .= '://';

        if (isset($url_info['host'])) {
            $url .= $url_info['host'];
        }

        if (isset($url_info['port'])) {
            $url .= ':' . $url_info['port'];
        }

        parse_str($url_info['query'], $query);

        // Start changing the URL query into a path
        $paths = [];

        // Parse the query into its separate parts
        $parts = explode('&', $url_info['query']);

        foreach ($parts as $part) {
            $pair = explode('=', $part);

            $key = isset($pair[0]) ? (string) $pair[0] : '';
            $value = isset($pair[1]) ? (string) $pair[1] : '';

            $index = md5($key . '-' . $value . '-' . $store_id . '-' . $language_id);

            if (!isset($this->seo_url_values[$index])) {
                $this->seo_url_values[$index] = $this->model_extension_ps_indexnow_feed_ps_indexnow->getSeoUrlByKeyValue($key, $value, $store_id, $language_id);
            }

            if ($this->seo_url_values[$index]) {
                $paths[] = $this->seo_url_values[$index];

                unset($query[$key]);
            }
        }

        $sort_order = [];

        foreach ($paths as $key => $value) {
            $sort_order[$key] = $value['sort_order'];
        }

        array_multisort($sort_order, SORT_ASC, $paths);

        // Build the path
        $url .= str_replace('/index.php', '', $url_info['path']);

        foreach ($paths as $result) {
            $url .= '/' . $result['keyword'];
        }

        // Rebuild the URL query
        if ($query) {
            $url .= '?' . str_replace(['%2F'], ['/'], http_build_query($query));
        }

        return $url;
    }

    /**
     * Retrieves the contents of a template file based on the provided route.
     *
     * This method checks if an event template buffer is provided. If so, it returns that buffer.
     * If not, it constructs the template file path based on the current theme settings and checks
     * for the existence of the template file. If the file exists, it reads and returns its contents.
     * It supports loading templates from both the specified theme directory and the default template directory.
     *
     * @param string $route The route for which the template is being retrieved.
     *                      This should match the naming convention for the template files.
     * @param string $event_template_buffer The template buffer that may be passed from an event.
     *                                       If provided, this buffer will be returned directly,
     *                                       bypassing file retrieval.
     *
     * @return mixed Returns the contents of the template file as a string if it exists,
     *               or false if the template file cannot be found or read.
     */
    protected function getTemplateBuffer(string $route, string $event_template_buffer): mixed
    {
        if ($event_template_buffer) {
            return $event_template_buffer;
        }

        if (defined('DIR_CATALOG')) {
            $dir_template = DIR_TEMPLATE;
        } else {
            if ($this->config->get('config_theme') == 'default') {
                $theme = $this->config->get('theme_default_directory');
            } else {
                $theme = $this->config->get('config_theme');
            }

            $dir_template = DIR_TEMPLATE . $theme . '/template/';
        }

        $template_file = $dir_template . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            $template_file = $this->modCheck($template_file);

            return file_get_contents($template_file);
        }

        if (defined('DIR_CATALOG')) {
            return false;
        }

        $dir_template = DIR_TEMPLATE . 'default/template/';
        $template_file = $dir_template . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            $template_file = $this->modCheck($template_file);

            return file_get_contents($template_file);
        }

        // Support for OC4 catalog
        $dir_template = DIR_TEMPLATE;
        $template_file = $dir_template . $route . '.twig';

        if (file_exists($template_file) && is_file($template_file)) {
            $template_file = $this->modCheck($template_file);

            return file_get_contents($template_file);
        }

        return false;
    }

    /**
     * Checks and modifies the provided file path based on predefined directory constants.
     *
     * This method checks if the file path starts with specific directory constants (`DIR_MODIFICATION`,
     * `DIR_APPLICATION`, and `DIR_SYSTEM`). Depending on these conditions, it modifies the file path to
     * point to the appropriate directory under `DIR_MODIFICATION`.
     *
     * - If the file path starts with `DIR_MODIFICATION`, it checks if it should point to either the
     *   `admin` or `catalog` directory based on the definition of `DIR_CATALOG`.
     * - If `DIR_CATALOG` is defined, the method checks for the file in the `admin` directory.
     *   Otherwise, it checks in the `catalog` directory.
     * - If the file path starts with `DIR_SYSTEM`, it checks for the file in the `system` directory
     *   within `DIR_MODIFICATION`.
     *
     * The method ensures that the returned file path exists before modifying it.
     *
     * @param string $file The original file path to check and modify.
     * @return string|null The modified file path if found, or null if it does not exist.
     */
    protected function modCheck(string $file): mixed
    {
        if (defined('DIR_MODIFICATION')) {
            if ($this->startsWith($file, DIR_MODIFICATION)) {
                if (defined('DIR_CATALOG')) {
                    if (file_exists(DIR_MODIFICATION . 'admin/' . substr($file, strlen(DIR_APPLICATION)))) {
                        $file = DIR_MODIFICATION . 'admin/' . substr($file, strlen(DIR_APPLICATION));
                    }
                } else {
                    if (file_exists(DIR_MODIFICATION . 'catalog/' . substr($file, strlen(DIR_APPLICATION)))) {
                        $file = DIR_MODIFICATION . 'catalog/' . substr($file, strlen(DIR_APPLICATION));
                    }
                }
            } elseif ($this->startsWith($file, DIR_SYSTEM)) {
                if (file_exists(DIR_MODIFICATION . 'system/' . substr($file, strlen(DIR_SYSTEM)))) {
                    $file = DIR_MODIFICATION . 'system/' . substr($file, strlen(DIR_SYSTEM));
                }
            }
        }

        return $file;
    }

    /**
     * Checks if a given string starts with a specified substring.
     *
     * This method determines if the string $haystack begins with the substring $needle.
     *
     * @param string $haystack The string to be checked.
     * @param string $needle The substring to search for at the beginning of $haystack.
     *
     * @return bool Returns true if $haystack starts with $needle; otherwise, false.
     */
    protected function startsWith(string $haystack, string $needle): bool
    {
        if (strlen($haystack) < strlen($needle)) {
            return false;
        }

        return (substr($haystack, 0, strlen($needle)) == $needle);
    }

    /**
     * Replaces specific occurrences of a substring in a string with a new substring.
     *
     * This method searches for all occurrences of a specified substring ($search) in a given string ($string)
     * and replaces the occurrences at the positions specified in the $nthPositions array with a new substring ($replace).
     *
     * @param string $search The substring to search for in the string.
     * @param string $replace The substring to replace the found occurrences with.
     * @param string $string The input string in which replacements will be made.
     * @param array $nthPositions An array of positions (1-based index) indicating which occurrences
     *                            of the search substring to replace.
     *
     * @return mixed The modified string with the specified occurrences replaced, or the original string if no matches are found.
     */
    protected function replaceNth(string $search, string $replace, string $string, array $nthPositions): mixed
    {
        $pattern = '/' . preg_quote($search, '/') . '/';
        $matches = [];
        $count = preg_match_all($pattern, $string, $matches, PREG_OFFSET_CAPTURE);

        if ($count > 0) {
            foreach ($nthPositions as $nth) {
                if ($nth > 0 && $nth <= $count) {
                    $offset = $matches[0][$nth - 1][1];
                    $string = substr_replace($string, $replace, $offset, strlen($search));
                }
            }
        }

        return $string;
    }

    /**
     * Replaces placeholders in a template with corresponding values from the views array.
     *
     * This method retrieves the template content based on the given route and template name,
     * then replaces specified search strings with their corresponding replace strings.
     * If positions are specified, the method performs replacements only at those positions.
     *
     * @param string $route The route associated with the template.
     * @param string $template The name of the template to be processed.
     * @param array $views An array of associative arrays where each associative array contains:
     *                     - string 'search': The string to search for in the template.
     *                     - string 'replace': The string to replace the 'search' string with.
     *                     - array|null 'positions': (Optional) An array of positions
     *                     where replacements should occur. If not provided,
     *                     all occurrences will be replaced.
     *
     * @return mixed The modified template content after performing the replacements.
     */
    protected function replaceViews(string $route, string $template, array $views): mixed
    {
        $output = $this->getTemplateBuffer($route, $template);

        foreach ($views as $view) {
            if (isset($view['positions']) && $view['positions']) {
                $output = $this->replaceNth($view['search'], $view['replace'], $output, $view['positions']);
            } else {
                $output = str_replace($view['search'], $view['replace'], $output);
            }
        }

        return $output;
    }
}
