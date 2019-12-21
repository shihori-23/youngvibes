<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceStory;

class ServiceStoriesController extends Controller
{

    //コマデータ取得
    public function comaImgSave(Request $request){

        $img = $request->data; //画像データの取得
        $imgPevNum = $request->id_data; // 前ストーリーのidの取得
        $imgSelect = $request->coma_data; // 使用されてコマのidを取得
        $imgSelectArray = explode(",",$imgSelect);//使用したコマid文字列を配列にブチ込む
        
        //配列をループ処理で解体
        for($i = 0; $i < count($imgSelectArray); $i++){
        
        }

        
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //画像保存ファイル名を前のコマのc_idから生成
        $imgNum = $imgPevNum + 1;
        $fileName = 'img/story/s_'.$imgNum .'.png';
        file_put_contents($fileName, $fileData);

        //DBにファイル名とユーザーIDをインサート
        $images = new ServiceStory;
        $postImageName = 's_'.$imgNum .'.png';
        $images->insert([
                'merge_img_file' => $postImageName,
                'email' => $imgSelect
             ]);
        return redirect('/top');     
    }
}
