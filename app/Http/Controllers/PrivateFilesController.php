<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PrivateFilesController extends Controller
{
    public function show($filename)
    {
        if(!Auth::check()){
            abort(404);
        }

        $exists = Storage::exists('upload/'.$filename);

        if($exists) {
            //get content of image
            $content = Storage::get('upload/'.$filename);
            
            //get mime type of image
            $mime = Storage::mimeType('upload/'.$filename);
            //prepare response with image content and response code
            $response = Response::make($content, 200);
            //set header 
            $response->header("Content-Type", $mime);
            // return response
            return $response;
        } else {
            abort(404);
        }
    }
}
