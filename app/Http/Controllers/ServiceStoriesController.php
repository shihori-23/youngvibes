<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceStory;

class ServiceStoriesController extends Controller
{

    // //コマデータ取得
    // public function comaImgSave(Request $request){

    //     $img = $request->data; //画像データの取得
    //     $imgTitle = $request->title_data; // 前ストーリーのidの取得
    //     $imgPevNum = $request->id_data; // タイトルの取得
    //     $imgSelect = $request->coma_data; // 使用されてコマのidを取得
    //     $imgSelectArray = explode(",",$imgSelect);//使用したコマid文字列を配列にブチ込む
    //     $insertImgArray = [];//インサートするようの空の配列を用意 

    //     $img = str_replace('data:image/png;base64,', '', $img);
    //     $img = str_replace(' ', '+', $img);
    //     $fileData = base64_decode($img);
    //     //画像保存ファイル名を前のコマのs_idから生成
    //     $imgNum = $imgPevNum + 1;
    //     $fileName = 'img/story/s_'.$imgNum .'.png';
    //     file_put_contents($fileName, $fileData);

    //     //DBにファイル名とユーザーIDをインサート
    //     $images = new ServiceStory;
    //     $postImageName = 's_'.$imgNum .'.png';

    //     //インサートするようの配列を作成
    //     for($i = 0; $i < count($imgSelectArray); $i++){
    //         array_push($insertImgArray,['story_title' => $imgTitle,'merge_img_file'=>$postImageName,'img_file' => $imgSelectArray[$i]]);
    //     }
       
    //     $images->insert($insertImgArray);
    //     return redirect('/top');     
    // }
}
