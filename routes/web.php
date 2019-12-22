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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::get('/top', function () {
    if (Auth::check()) {
        return view('top');
    } else {
        return route('login');
    }
});

Route::get('/top', 'ServiceContentsController@index');

Route::get('/mypage_story_all', function () {
    return view('mypage_story_all');
});

Route::get('/coma_create', function () {
    return view('coma_create');
});



//mypage
Route::get('/mypage', function () {
    $service_contents = ServiceContent::orderBy('id', 'asc')->where('email', Auth::user()->email)->get();
    // $service_contents = ServiceContent::orderBy('id', 'asc')->get();
    return view('mypage', [
        'service_contents' => $service_contents
    ]);
});

//mypage_my_story 自分のコマが使われているコラージュの表示
Route::get('/mypage/story', function () {
    $service_stories = DB::table('service_stories')
        ->join('service_contents', 'service_stories.img_file', '=', 'service_contents.img_file')->get();
    // $service_contents = ServiceContent::orderBy('id', 'asc')->get();
    return view('mypage_story', [
        'service_stories' => $service_stories
    ]);
});

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

Route::get('/header', function () {
    return view('header');
});

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'user.logout'
]);


//辻編集中※あとでリンク先を変更！
Route::get('/test.create', function () {
    return view('test_story_create');
});

Route::get('/test_story_create', function () {
    $service_contents = ServiceContent::orderBy('id', 'des')->get();
    $service_stories = ServiceStory::orderBy('id', 'des')->first();
    return view('test_story_create', [
        'service_contents' => $service_contents,
        'service_stories' => $service_stories
    ]);
});

//辻編集 ※あとでリンク先を変更！
Route::post('/story_create/save', 'ServiceStoriesController@comaImgSave');

