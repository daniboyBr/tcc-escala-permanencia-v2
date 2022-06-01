<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PrivateFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['create','edit','update','destroy']);
    }

    public function show($folder, $file)
    {
        if(!Auth::check()){
            abort(404);
        }

        $path = $folder.'/'.$file;

        $exists = Storage::exists($path);

        if($exists) {
            //get content of image
            $content = Storage::get($path);
            
            //get mime type of image
            $mime = Storage::mimeType($path);
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
