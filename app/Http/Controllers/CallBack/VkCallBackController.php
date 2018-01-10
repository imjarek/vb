<?php

/**
 * @class VkCallBackController
 * https://vk.com/dev/bots_docs
 * https://vk.com/dev/bizmessages_doc
 * https://vk.com/dev/objects/message
 */

namespace App\Http\Controllers\CallBack;

use App\Bonusway\BWCommands;
use App\Models\BwUser;
use Illuminate\Http\Request;
use App\Models\VkBot;
use App\Models\Command;
use App\SocialApi\VkApi;

class VkCallBackController extends CallBackController
{
    /** @var VkApi $API */
    protected $API;
    /** @var VkBot $VkBot */
    protected $Bot;


    /**
     * Обработка запроса от CallBack API VK
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groupId = $request->input('group_id');
        $action  = $request->input('type');

        if($this->Bot = VkBot::whereIdGroup($groupId)->isEnable()->first()){
            $this->API = new VkApi($this->Bot);
            if(method_exists($this, $action)) {
                return $this->$action($request);
            }
        }

        return $this->sendResponse();
    }


    /**
     * Confirmation
     *
     * Подверждие бота в настройках сообщетва ВК
     *
     * @return \Illuminate\Http\Response
     */
    protected function confirmation()
    {
        return $this->sendResponse($this->Bot->response_api);
    }


    /**
     * Send message
     *
     * Если пришло новое сообщение от пользователя ВК
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    protected function message_new(Request $request)
    {
        $vkMessage = $request->input('object');

        $this->API->messagesMarkAsRead($vkMessage['id']);

        /** @var BwUser $bwUser */
        $bwUser = BwUser::firstOrCreate(['vk_user_id' => (int)$vkMessage['user_id']]);
        
        try{
            if($commands = $this->getCommands($bwUser->vk_user_id, $vkMessage['body'])){
                //dd($commands);
                foreach ($commands as $command){
                    /** @var Command $command */
                    //dd($command);
                    $command->executeVkSnippets($vkMessage, $this->API, $this->Bot);

                    if($command->type === 'bw'){
                        $BWCommand = new BWCommands($bwUser, $vkMessage['body']);
                        $this->API->messageSend($bwUser->vk_user_id, $BWCommand->execCommand($command));
                    }else{
                        $this->API->messageSend($bwUser->vk_user_id, $command->message);
                    }
                }
            }
        }catch (\Exception $e){

        }

        //return $this->sendResponse();
    }

}