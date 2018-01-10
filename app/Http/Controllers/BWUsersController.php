<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BwUser;

class BwUsersController extends Controller
{   
    public function __construct() {
        \Debugbar::disable();
    }

    public function updateUser(Request $request)
    {   
        $sentHash = base64_decode($request->header('X-Bot-Hash'));
        $localHash = hash_hmac('sha256', $request->getContent(), env('VK_BOT_SECRET'));
        
        if (empty($sentHash) || $sentHash !== $localHash) {
            throw new \Exception('Not authorized');
        }
        
        $data = json_decode($request->getContent());
        if (!$data && !is_object($data)) {
            throw new \Exception('Bad request');
        }
        $bwUserId = $data->bw_user_id;
        $vkUserId = $data->vk_user_id;
        $token = $data->token;
        
        if (!($bwUserId && $vkUserId && $token)) {
            throw \Exception('Invalid parameters');
        }
        
        $bwUser = BwUser::where(['vk_user_id' => $vkUserId])->first();
        
        if (!$bwUser) {
            return 'User not found';
        }
        $bwUser->update([
            'bw_user_id' => $bwUserId,
            'token' => $token
        ]);
        return 'User updated';
    }
}