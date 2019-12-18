<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceContent;
use Auth;

class ServiceContentController extends Controller
{
    //コマデータ取得
    public function comaGet(){
            $comas = ServiceContent::all();
            return view('top',[
                'comas' => $comas
            ]);
    }

    //coma_create.blade.phpの前回のコマを表示する
    public function comaPev(){
        // コマのデータを降順で１レコード取得
        $comas = ServiceContent::orderBy('c_id','dec')->first();
        return view('coma_create',[
        'comas' => $comas
        ]);
    }

    //コマデータ取得
    public function comaSave(Request $request){

        
        $img = $request->data; //画像データの取得
        $imgPevNum = $request->imgNamePev; // 前コマのc_idの取得
        
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //画像保存ファイル名を前のコマのc_idから生成
        $imgNum = $imgPevNum + 1;
        $fileName = 'img/'.$imgNum .'.png';
        file_put_contents($fileName, $fileData);

        //DBにファイル名とユーザーIDをインサート
        $images = new ServiceContent;
        $images->insert([
                'img_file' => $fileName,
                'u_id' => 'aaa'
             ]);
        return redirect('/');     
    }

}
