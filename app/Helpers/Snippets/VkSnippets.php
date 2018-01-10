<?php

namespace App\Helpers\Snippets;

use App\SocialApi\VkApi;
use App\Models\VkBot;
use App\Models\Command;
use App\Bonusway\BWApi;

/**
 * Trait VkSnippets
 * @package App\Helpers\Snippets
 *
 * @params App\Models\VkBot $vk_bot
 */
trait VkSnippets
{
    use Snippets;

    /** @var VkApi $vkApi */
    private $vkApi;
    /** @var VkBot $vkBot */
    private $vkBot;
    private $vkMessage;

    protected $vkSnippets = [
        'vk_first_name',
        'vk_last_name',
        'vk_full_name',
        'bw_login'
    ];

    public function getVkSnippets()
    {
        return array_merge($this->vkSnippets, $this->getSnippets());
    }

    /**
     * @param string $vkMessage
     * @param VkApi $vkApi
     * @param VkBot $vkBot
     */
    public function executeVkSnippets($vkMessage, $vkApi, $vkBot)
    {
        $this->vkApi = $vkApi;
        $this->vkBot = $vkBot;
        $this->vkMessage = $vkMessage;

        $this->executeSnippets($this->getVkSnippets());
    }

    /*
     * METHODS
     */
    private function vkFirstName($snippet)
    {
        $name = '';
        $nameData = $this->vkApi->usersGet($this->vkMessage['user_id']);
        if(!$nameData['error'])
            $name = $nameData['data'][0]['first_name'];
        $this->replaceSnippet($snippet, $name);
    }

    private function vkLastName($snippet)
    {
        $name = '';
        $nameData = $this->vkApi->usersGet($this->vkMessage['user_id']);
        if(!$nameData['error'])
            $name = $nameData['data'][0]['last_name'];
        $this->replaceSnippet($snippet, $name);
    }

    private function vkFullName($snippet)
    {
        $name = '';
        $nameData = $this->vkApi->usersGet($this->vkMessage['user_id']);
        if(!$nameData['error'])
            $name = "{$nameData['data'][0]['last_name']} {$nameData['data'][0]['first_name']}";
        $this->replaceSnippet($snippet, $name);
    }

    private function bwLogin($snippet)
    {
        $this->replaceSnippet($snippet, BWApi::BW_AUTH_LINK);
    }


}