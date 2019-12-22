<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceContent;
use Auth;

class ServiceContentController extends Controller
{
    //topページでコマデータ取得
    public function comaGet(){
            $comas = ServiceContent::orderBy('id','dec')->get();
            return view('top',[
                'comas' => $comas
            ]);
    }

    //long_storyページでコマデータ取得
    public function comaGetToLong(){
            $comas = ServiceContent::orderBy('id','dec')->get();
            return view('long_story',[
                'comas' => $comas
            ]);
    }

    //coma_create.blade.phpの前回のコマを表示する
    public function comaPev(){
        // コマのデータを降順で１レコード取得
        $comas = ServiceContent::orderBy('id','dec')->first();
        return view('coma_create',[
        'comas' => $comas
        ]);
    }

    //コマデータ取得
    public function comaSave(Request $request){
 
        $img = $request->data; //画像データの取得
        $imgPevNum = $request->imgNamePev; // 前コマのidの取得
        $imgEmail = $request->imgEmail; // 前コマのemailの取得
        
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //画像保存ファイル名を前のコマのc_idから生成
        $imgNum = $imgPevNum + 1;
        $fileName = 'img/coma/c_'.$imgNum .'.png';
        file_put_contents($fileName, $fileData);

        //DBにファイル名とユーザーIDをインサート
        $images = new ServiceContent;
        $postImageName = 'c_'.$imgNum .'.png';
        $images->insert([
                'img_file' => $postImageName,
                'email' => $imgEmail
             ]);
        return redirect('/top');     
    }
    
    }
