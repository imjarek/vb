<?php

namespace App\Http\Controllers\CallBack;

use Illuminate\Http\Request;
use App\Bonusway\VkAuth;

class BwCallBackController extends CallBackController
{
    public function index(Request $request)
    {
        VkAuth::webHook($request);
        $this->sendResponse();
    }
}