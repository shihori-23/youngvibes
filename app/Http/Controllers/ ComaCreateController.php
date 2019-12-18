<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComaCreate;
use Validator;
use Auth;

class ImageController extends BaseController
{

     public function __construct(){
        $this->middleware('auth');
     }

    //画像の保存とアップロード
    public function save(Request $request) {

        // $img = $_POST['data'];
        // $img = str_replace('data:image/png;base64,', '', $img);
        // $img = str_replace(' ', '+', $img);
        // $fileData = base64_decode($img);
        // //saving
        // $dir = 'public/img/';
        // $fileName = 'photo.png';
        // file_put_contents($fileName, $fileData);
       
    }

}

