<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class ImageController extends BaseController
{

    public function __construct(){
        $this->middleware('auth');
     }
     
    //全ての画像の処理
    public function save(Request $request) {
       
    }

}

