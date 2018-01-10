<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UploadsImageHelper;

class MediaController extends Controller
{
    /**
     * Upload image in TMP dir
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadTmpImage(Request $request)
    {
        $uploadedImage = [];

        if($request->hasFile('file')){
            $image = $request->file('file');
            $uploadedImage = UploadsImageHelper::saveInTmp($request->user()->id, $image);
        }

        return response()->json($uploadedImage);
    }


}