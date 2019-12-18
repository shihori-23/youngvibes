<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceContentController extends Controller
{
    //コマデータ取得
    public function comaGet(){
            $comas = ServiceContent::all();
            return view('comas',[
                'comas' => $comas
            ]);
    }
}
