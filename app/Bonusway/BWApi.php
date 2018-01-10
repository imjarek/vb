<?php

namespace App\Bonusway;

use App\Models\BwUser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception;

class BWApi
{
    const BW_AUTH_LINK = "https://oauth.vk.com/authorize?client_id=4622348&redirect_uri=https://www.kopikot.ru/oauth-login?type=vkontakte&response_type=token&scope=email&scope=offline&display=page";

    private $secret_key;
    private $vk_bw_user;
    private $client;

    public function __construct(BwUser $bwUser)
    {
        $this->secret_key = env('BW_SECRET', 'c67684677d79d39930dd4dc00d3cc368');
        $this->vk_bw_user = $bwUser;
        $this->debug = false;
        $this->timeout = 10;
        $this->apiUrl = env('BW_HOST_API', 'https://api.bonusway.com');
        
        $this->params = array(
            'headers'  => [
                'Accept'          => 'application/json',
                'Accept-Language' => 'ru',
                'Authorization'   => 'Bonusway version="1.0" token="'.$bwUser->token.'"',
                'Cache-Control'   => 'no-cache',
                'X-Bonusway-Locale' => 'ru'
            ],
            'verify' => false,
            'debug' => $this->debug,
            'timeout' => $this->timeout,
        );

        $this->client = new Client();
    }

    public function send($url)
    {
        $data = [
            'code' => 500,
            'auth' => self::BW_AUTH_LINK,
            'body' => '',
        ];
        try {
            if($this->vk_bw_user->bw_user_id){
                $response = $this->client->get("$this->apiUrl/$url", $this->params);
                $data['code'] = (int)$response->getStatusCode();
                $data['body'] = $response->getBody();
            }else{
                $data['code'] = 401;
            }
        }catch (Exception $e){
            $data['code'] = (int)$e->getCode();
        }
        return $data;
    }
}