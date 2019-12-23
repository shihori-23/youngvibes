<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;
use App\ServiceContent;
use App\ServiceStory;
use App\ContentsStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/mypage_story_all', function () {
    return view('mypage_story_all');
});

//mypage
Route::get('/mypage', function () {
    if (Auth::check()) {
        $service_contents = ServiceContent::orderBy('id', 'asc')->where('email', Auth::user()->email)->get();
        // $service_contents = ServiceContent::orderBy('id', 'asc')->get();
        return view('mypage', [
            'service_contents' => $service_contents
        ]);
    } else {
        return redirect('login');
    }
});

//mypage_my_story 自分のコマが使われているコラージュの表示
Route::get('/mypage/story', function () {
    if (Auth::check()) {
        $service_stories = DB::table('service_contents')
            ->join('contents_stories', 'service_contents.id', '=', 'contents_stories.img_file')
            ->where('email', Auth::user()->email)
            ->select('contents_stories.merge_img_file')
            ->get();

        $merge_files = [];
        foreach ($service_stories as $service_story) {
            array_push($merge_files, $service_story->merge_img_file);
        }
        $merge_files = array_unique($merge_files);
        return view('mypage_story', [
            'merge_files' => $merge_files
        ]);
    } else {
        return redirect('login');
    }
});
//mypage_my_story 自分のコマが使われているコラージュの表示
// Route::get('/mypage/story', function () {
//     if (Auth::check()) {
//         $service_stories = DB::table('service_contents')
//             ->join('contents_stories', 'service_contents.id', '=', 'contents_stories.img_file')
//             ->where('email', Auth::user()->email)
//             ->select('contents_stories.merge_img_file')
//             ->get();

//         return view('mypage_story', [
//             'service_stories' => $service_stories
//         ]);
//     } else {
//         return redirect('login');
//     }
// });

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/tutorial', function () {
    return view('auth/tutorial');
});


//全コマのデータをservice_contentsから取得する
// Route::get('/', function () {
//     $service_contents = ServiceContent::all(); 
//     return view('service_contents', [
//     'service_contents' => $service_contents ]);
// });

//コマの画像をTOPに表示
Route::get('/top', 'ServiceContentController@comaGet');


//coma_create.blade.phpの前回のコマを表示する
Route::get('/coma_create', 'ServiceContentController@comaPev');

//coma_create.blade.php コマ作成後に画像を保存
Route::post('/coma_create/save', 'ServiceContentController@comaSave');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
//コマの画像をlong_storyに表示
Route::get('/long_story', 'ServiceContentController@comaGetToLong');

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'user.logout'
]);

//story_allにルート定義
Route::get('/story_all', function () {
    return view('story_all');
});

// Route::get('/coma_create/{testcode}', 'ServiceContentController@indextest');
Route::get('/get_count', function () {
    return view('get_count');
});


//story_create.blade.phpのルート定義
// Route::get('/story_create', function () {
//     return view('story_create');
// });

//story_create.blade.phpへ諸々のデータを送る
Route::get('/story_create', function () {
    if (Auth::check()) {
        $service_contents = ServiceContent::orderBy('id', 'des')->get();
        $service_stories = ServiceStory::orderBy('id', 'des')->first();
        return view('story_create', [
            'service_contents' => $service_contents,
            'service_stories' => $service_stories
        ]);
    } else {
        return redirect('login');
    }
});

//story_create.blade.phpからpostデータServiceStoriesControllerで処理する定義
// Route::post('/story_create/save', 'ServiceStoriesController@comaImgSave');




//story_createからのpostデータを各テーブルに格納
Route::post('/story_create/save', function (Request $request) {

    $img = $request->data; //画像データの取得
    $imgTitle = $request->title_data; // 前ストーリーのidの取得
    $imgPevNum = $request->id_data; // タイトルの取得
    $imgSelect = $request->coma_data; // 使用されてコマのidを取得
    $imgSelectArray = explode(",", $imgSelect); //使用したコマid文字列を配列にブチ込む
    $insertImgArray = []; //インサートするようの空の配列を用意 

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);
    //画像保存ファイル名を前のコマのs_idから生成
    $imgNum = $imgPevNum + 1;
    $fileName = 'img/story/s_' . $imgNum . '.png';
    file_put_contents($fileName, $fileData);
    //DBに保存するためのファイル名を生成
    $postImageName = 's_' . $imgNum . '.png';


    //ServiceStoryテーブルにファイル名とタイトルを格納
    $images = new ServiceStory;
    $images->insert([
        'story_title' => $imgTitle,
        'merge_img_file' => $postImageName
    ]);

    // contents_storiesテーブルに使用されたコマのデータを格納
    $stories = new ContentsStory;
    //インサートするようの配列を作成
    for ($i = 0; $i < count($imgSelectArray); $i++) {
        array_push($insertImgArray, ['merge_img_file' => $postImageName, 'img_file' => $imgSelectArray[$i]]);
    }

    $stories->insert($insertImgArray);
    return redirect('/top');
});
