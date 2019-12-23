<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceContent;
use Auth;

class ServiceContentController extends Controller
{
    //topページでコマデータ取得
    public function comaGet()
    {
        if (Auth::check()) {
            $comas = ServiceContent::orderBy('id', 'dec')->get();
            return view('top', [
                'comas' => $comas
            ]);
        } else {
            return redirect('login');
        }
    }

    //long_storyページでコマデータ取得
    public function comaGetToLong()
    {
        if (Auth::check()) {
            $comas = ServiceContent::orderBy('id', 'dec')->get();
            return view('long_story', [
                'comas' => $comas
            ]);
        } else {
            return redirect('login');
        }
    }

    //coma_create.blade.phpの前回のコマを表示する
    public function comaPev()
    {
        if (Auth::check()) {
            // コマのデータを降順で１レコード取得
            $comas = ServiceContent::orderBy('id', 'dec')->first();
            return view('coma_create', [
                'comas' => $comas
            ]);
        } else {
            return redirect('login');
        }
    }

    //コマデータ取得
    public function comaSave(Request $request)
    {

        $img = $request->data; //画像データの取得
        $imgPevNum = $request->imgNamePev; // 前コマのidの取得
        $imgEmail = $request->imgEmail; // 前コマのemailの取得

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        //画像保存ファイル名を前のコマのc_idから生成
        $imgNum = $imgPevNum + 1;
        $fileName = 'img/coma/c_' . $imgNum . '.png';
        file_put_contents($fileName, $fileData);

        //DBにファイル名とユーザーIDをインサート
        $images = new ServiceContent;
        $postImageName = 'c_' . $imgNum . '.png';
        $images->insert([

                'img_file' => $postImageName,
                'email' => $imgEmail
             ]);
        return redirect('/top');     
    }


    public function indextest(Request $request)
    {
        $comas = ServiceContent::orderBy('id','dec')->first();
        return Response::json('coma_create',[
        'comas' => $comas
        ]);
        // return view('coma_create',[
        // 'comas' => $comas
        // ]);
        // $response = array();
        // $response["status"] = "OK";
        // $response["message"] = $request;
        // return Response::json($request);
    }
    
}
