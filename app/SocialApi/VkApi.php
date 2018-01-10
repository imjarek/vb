<?php

namespace App\SocialApi;

use App\Models\VkBot;

/**
 * Class VkApi
 * @package App\SocialApi
 * @property VkBot $bot
 */
class VkApi extends SocialApi implements SocialApiInterface
{
    protected $api_url = 'https://api.vk.com/method/';
    protected $api_ver = '5.63';
    protected $debug   = false;

    public function __construct($bot)
    {
        parent::__construct($bot);
        $this->token = $this->bot['vk_key'];
    }

    protected function sendAPI($method, $params = [], $addToken = true)
    {
        sleep(3);

        if($addToken)
            $params['access_token'] = $this->token;
        $params['v'] = $this->api_ver;

        $response = parent::sendAPI($method, 'GET', $params);

        if($response->getStatusCode() === 200){
            $dataJson = json_decode($response->getBody(), true);

            $error = empty($dataJson['error']) ? [] : $dataJson['error'];
            $data  = empty($dataJson['response']) ? [] : $dataJson['response'];

            return [
                'code'     => $error ? $error['error_code'] : 0,
                'error'    => $error ? $error['error_msg'] : false,
                'data'     => $data,
                'response' => $dataJson
            ];
        }

        return false;
    }

    /*
     * Methods VK API
     */

    /**
     * Отправка сообщения пользователю
     * @param int $userId     - VK user id
     * @param string $body    - text message
     * @param int $randomInt  - random int from: 0 to: 100000
     * @return bool|mixed|\Psr\Http\Message\ResponseInterface
     */
    public function messageSend($userId, $body, $randomInt = 0)
    {
        $params = [
            'user_id'   => $userId,
            'random_id' => $randomInt ?: random_int(1, 100000),
            'message'   => $body
        ];
        var_dump($body);
        return $this->sendAPI('messages.send', $params);
    }

    /**
     * Статус прочитанно
     * @param int $messageId
     * @return array|bool|mixed|\Psr\Http\Message\ResponseInterface
     */
    public function messagesMarkAsRead($messageId)
    {
        return $this->sendAPI('messages.markAsRead', ['message_ids' => $messageId]);
    }

    /**
     * Информация о пользователе
     * @param int $userId     - Vk user id
     * @return bool|mixed|\Psr\Http\Message\ResponseInterface
     */
    public function usersGet($userId)
    {
        return $this->sendAPI('users.get', ['user_ids' => $userId], false);
    }

    /**
     * Список диалогов бота
     * @param int $offset
     * @param int $count
     * @return bool|mixed|\Psr\Http\Message\ResponseInterface
     */
    public function messagesGetDialogs($offset = 0, $count = 10)
    {
        return $this->sendAPI('messages.getDialogs', ['offset' => $offset, 'count'  => $count]);
    }

    /**
     * @param int $userId
     * @param int $offset
     * @param int $count
     * @return bool|mixed|\Psr\Http\Message\ResponseInterface
     */
    public function messagesGetHistory($userId, $offset = 0, $count = 10)
    {
        return $this->sendAPI('messages.getHistory', [
            'user_id' => $userId,
            'offset'  => $offset,
            'count'   => $count,
        ]);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function isFirstMessageInDialog($userId)
    {
        $outTime = time() - 60 * 60;

        if($historyDialog = $this->messagesGetHistory($userId, 0, 2)){
            return (count($historyDialog['data']['items']) === 2 && $historyDialog['data']['items'][1]['date'] > $outTime)
                ? false
                : true;
        };

        return false;
    }
}