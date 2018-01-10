<?php

namespace App\SocialApi;

use App\Models\VkBot;
use GuzzleHttp\Client;

interface SocialApiInterface {
    public function isFirstMessageInDialog($userId);
    public function messageSend($userId, $body);
}

class SocialApi
{
    protected $bot;
    protected $client;
    protected $token = '';
    protected $api_url = '';
    protected $api_ver = '1';
    protected $debug = false;


    /**
     * SocialApi constructor.
     * @param \Eloquent|array $bot
     */
    public function __construct($bot)
    {
        $this->client = new Client([
            'base_uri' => $this->api_url,
            'timeout'  => 10
        ]);

        if($bot instanceof VkBot)
            $this->bot = $bot->toArray();
        elseif(is_array($bot))
            $this->bot = $bot;
        else
            return false;

        return $this;
    }

    /**
     * Send api
     * @param string $method
     * @param string $type
     * @param array $query
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function sendAPI($method, $type = 'get', $query = [])
    {
        return $this->client->request($type, $method, [
            'debug' => (bool)$this->debug,
            'query' => $query
        ]);
    }

}