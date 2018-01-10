<?php

namespace App\Bonusway;

use App\Models\BwUser;
use App\Bonusway\BWApi;
use App\Models\Command;
use function GuzzleHttp\Psr7\str;

use Illuminate\Support\Facades\Log;

class BWCommands
{
    /** @var BWApi $BWApi */
    private $BWApi;
    /** @var BwUser $BWUser */
    private $BWUser;
    /** @var string $VKMessage */
    private $VKMessage;
    /** @var Command $command */
    private $command;

    public static $listCommands = [
        '/cashback-shop-url',
        '/cashback-shop-name',
    ];

    public function __construct(BwUser $bwUser, $vkMessage)
    {
        $this->BWUser = $bwUser;
        $this->BWApi = new BWApi($bwUser);
        $this->VKMessage = $vkMessage;
    }

    public function execCommand(Command $command)
    {
        $this->command = $command;
        $this->VKMessage = trim(str_replace($command->command, '', $this->VKMessage));

        $command = str_replace(['/'], '', $command->command);
        $command = camel_case($command);
        
        if(method_exists($this, $command))
            return $this->$command();

        return '';
    }

    private function responseToVk($responseBW)
    {
        if($responseBW['code'] === 401)
            return $responseBW['auth'];

        if($responseBW['code'] === 200 && !empty($responseBW['message'])){
            $result = str_replace('-response-', $responseBW['message'], $this->command->message);
            return $result;
        }

        return empty($this->command->error)
            ? 'Ошибка'
            : $this->command->error;
    }

    private function cashbackShopUrl()
    {
        $urlShop = urlencode($this->VKMessage);
        
        
        $response = $this->BWApi->send("users/{$this->BWUser->bw_user_id}/campaign?url={$urlShop}");
        
        if ($response['body']) {
            $response['message'] = $this->parseCashback($response['body']);
        }
       
        return $this->responseToVk($response);
    }

    private function cashbackShopName()
    {
        $nameShop = urlencode($this->VKMessage);
        $response = $this->BWApi->send("users/{$this->BWUser->bw_user_id}/campaign?name={$nameShop}");
        
        if ($response['body']) {
            $response['message'] = $this->parseCashback($response['body']);
        }
        return $this->responseToVk($response);
    }
    private function parseCashBack($data) {
        $data = json_decode($data);
        $bonus = $data->commission->original_amount * $data->commission->boost_amount;
        $unit = $data->commission->unit ? $data->commission->unit : '%';
        return "{$bonus}{$unit}";
    }
}