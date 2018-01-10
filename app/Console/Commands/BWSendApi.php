<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class BWSendApi extends Command
{
    protected $signature   = 'bw:send-api';
    protected $description = 'Test bonusway api';
    private $bw_user_id = '3645035';
    private $bw_user_token = '2c9917908658aeb6bd644ef8d4226f0d33b672ff0152b83083a63ec48dd4190f470fadd3c8f57e993c889';

    public function handle()
    {
        try{
            $client = new Client([
                'base_uri' => env('BW_HOST_API', 'https://api.bonusway.com/'),
                'headers'  => [
                    'Accept-Language' => 'ru',
                    'Authorization'   => 'Bonusway version="1.0" token="'.$this->bw_user_token.'"',
                    'cache-control'   => 'no-cache',
                ],
            ]);

            $request = $client->get("users/{$this->bw_user_id}/campaign?url=https%3A%2F%2Fwww.aliexpress.com");

            dd([
                'code' => $request->getStatusCode(),
                'body' => $request->getBody(),
                'json' => json_decode($request->getBody(), true),
            ]);
        }catch (\Exception $e){

            dd([
                'code' => $e->getCode(),
                'body' => $e->getMessage(),
                'prev' => $e->getPrevious(),
            ]);

        }
    }
}