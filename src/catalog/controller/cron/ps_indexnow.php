<?php
namespace Opencart\Catalog\Controller\Extension\PsIndexNow\Cron;

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
        $this->load->model('extension/ps_indexnow/feed/ps_indexnow');
        $this->load->model('setting/setting');
        $this->load->model('setting/store');

        $stores = array_merge(
            [['store_id' => 0, 'url' => $this->config->get('config_url')]],
            $this->model_setting_store->getStores(),
        );

        foreach ($stores as $store) {
            $this->submit_url($store);
        }
    }

    private function submit_url(array $store): void
    {
        $config = $this->model_setting_setting->getSetting('feed_ps_indexnow', $store['store_id']);

        if (isset($config['feed_ps_indexnow_status']) && (bool)$config['feed_ps_indexnow_status'] === false) {
            return;
        }


        if (isset($config['feed_ps_indexnow_service_status'])) {
            $services = $this->model_extension_ps_indexnow_feed_ps_indexnow->getServiceEndpoints((array) $config['feed_ps_indexnow_service_status']);
        } else {
            $services = [];
        }

        $service_key = isset($config['feed_ps_indexnow_service_key']) ? $config['feed_ps_indexnow_service_key'] : '';
        $service_key_location = isset($config['feed_ps_indexnow_service_key_location']) ? $config['feed_ps_indexnow_service_key_location'] : '';

        if (empty($services)) {
            return;
        }


        $server = $store['url'];
        $server_host = parse_url($server, PHP_URL_HOST);

        if ($store['store_id'] > 0) {
            $server = $store['url'];
            $server_host = parse_url($server, PHP_URL_HOST);
        }


        $filter_data = [
            'store_id' => $store['store_id'],
            'order' => 'ASC',
        ];

        $result = $this->model_extension_ps_indexnow_feed_ps_indexnow->getQueue($filter_data);

        $url_list = $result ? array_column($result, 'url') : [];

        
        $all_success = true;

        foreach ($services as $service) {
            $batches = array_chunk($url_list, 10000);

            foreach ($batches as $batch) {
                $status_code = $this->submitUrls(
                    $service['endpoint_url'] . 'no',
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
                        'store_id' => $store['store_id'],
                    ];
                }

                if ($all_success && $status_code !== 200) {
                    $all_success = false;
                }

                $this->model_extension_ps_indexnow_feed_ps_indexnow->addLog($log_data);

                sleep(1);
            }
        }

        if ($result && $services) {
            if ($queue_id_list = array_column($result, 'queue_id')) {
                $this->model_extension_ps_indexnow_feed_ps_indexnow->removeQueueItems($queue_id_list);
            }
        }
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
}
