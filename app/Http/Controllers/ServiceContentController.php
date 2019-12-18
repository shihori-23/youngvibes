<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceContent;
class ServiceContentController extends Controller
{
    //コマデータ取得
    public function comaGet(){
            $comas = ServiceContent::all();
            return view('top',[
                'comas' => $comas
            ]);
    }
}
