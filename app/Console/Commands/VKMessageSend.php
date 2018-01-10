<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VkBot;
use App\SocialApi\VkApi;

class VKMessageSend extends Command
{
    protected $signature   = 'vk:message-send';
    protected $description = 'Create user for application';
    protected $testBotId   = 145398741;  // vk group_id
    protected $testUserId  = 110395166;  // vk user_id

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newMessage = $this->ask('Write message', 'Test message');

        $bot = VkBot::whereIdGroup($this->testBotId)->first();
        $VkApi = new VkApi($bot);
        $status = $VkApi->messageSend($this->testUserId, $newMessage);
    }
}
