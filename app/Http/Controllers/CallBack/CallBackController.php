<?php

namespace App\Http\Controllers\CallBack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\SocialApi\VkApi;
use App\Models\VkBot;
use App\Models\Command;

class CallBackController extends Controller
{
    protected $defaultResponse = 'ok';
    /** @var VkApi $API */
    protected $API;
    /** @var VkBot $VkBot */
    protected $Bot;

    public function __construct()
    {
        \Debugbar::disable();
    }

    protected function getCommands($userId, $message)
    {
        $selectedCommands = collect();

        /** @var Command $Command */
        $command = $this->Bot->commands()->isEnable()->commandsInMessage($message)->first();

        if($command){
            $selectedCommands->push($command);
        }elseif($this->API->isFirstMessageInDialog($userId)){
            if($command = $this->Bot->commands()->isEnable()->firstMessage()->first())
                $selectedCommands->push($command);
        }else{
            if($command = $this->Bot->commands()->isEnable()->emptyMessage()->first()){
                $selectedCommands->push($command);
            }
        }
        return $selectedCommands;
    }

    protected function sendResponse($text = false)
    {   
        $text = $text ?: $this->defaultResponse;
        return new Response($text, 200);
    }
}