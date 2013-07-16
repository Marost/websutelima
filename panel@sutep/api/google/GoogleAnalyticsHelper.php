<?php
require_once("src/Google_Client");
require_once("src/contrib/Google_AnalyticsService");
 
/**
 * Helper para encapsular el uso de la api de google, para
 * consultar metricas de analytics.
 */
class GoogleAnalyticsHelper {
    private $config;
    private $client;
    private $service;
 
    /**
     * Constructor.
     */
    public function __construct() {
        $this->config = Configure::read('GOOGLE_API');
        $this->client = new Google_Client();
        $this->client->setApplicationName("...");
        $token = Cache::read('google-api-token', 'short');
        if($token) {
            $this->client->setAccessToken($token);
        }
 
        $key = file_get_contents($this->config['KEY_FILE']);
        $this->client->setAssertionCredentials(new Google_AssertionCredentials(
                $this->config['SERVICE_ACCOUNT_NAME'],
                array('https://www.googleapis.com/auth/analytics.readonly'),
                $key)
        );
 
        $this->client->setClientId($this->config['CLIENT_ID']);
        $this->service = new Google_AnalyticsService($this->client);
    }
 
    /**
     * Destructor.
     */
    public function __destruct() {
        if ($this->client->getAccessToken()) {
            Cache::write('google-api-token', $this->client->getAccessToken(), 'short');
        }
    }
}

?>