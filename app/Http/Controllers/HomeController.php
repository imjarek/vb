<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\VkApi;
use App\Models\VkBot;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $vk_key = '3a517fbb268080331e8c176d96f483b1ea988b3561803586e06a457d4759a94a460d145a8ce3737d68ead'; // Ключ доступа сообщества

//        $urlGetDialogs = "https://api.vk.com/method/messages.getDialogs?v=5.63&access_token={$vk_key}&count=200&offset=0";
//        $data = json_decode(file_get_contents($urlGetDialogs));


//        $urlSendMessage = "https://api.vk.com/method/messages.send?v=5.63&access_token={$vk_key}&user_id=110395166&random_id=1&message=alex";
//        $data = json_decode(file_get_contents($urlSendMessage));
//
//        dd($data);


        return view('welcome');
    }
}