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
use Illuminate\Http\Request;
// use App\ServiceContent;

Route::get('/', function () {
    return view('top');
});

Route::get('/', 'ServiceContentsController@index');

Route::get('/mypage_story_all', function () {
    return view('mypage_story_all');
});

Route::get('/coma_create', function () {
    return view('coma_create');
});




Route::get('/mypage', function () {
    return view('mypage');
});

Route::get('/login', function () {
    return view('login');
});

//全コマのデータをservice_contentsから取得する
// Route::get('/', function () {
//     $service_contents = ServiceContent::all(); 
//     return view('service_contents', [
//     'service_contents' => $service_contents ]);
// });

//コマの画像をTOPに表示
Route::get('/', 'ServiceContentController@comaGet');

//coma_create.blade.phpの前回のコマを表示する
Route::get('/coma_create', 'ServiceContentController@comaPev');

//coma_create.blade.php コマ作成後に画像を保存
Route::post('/coma_create/save', 'ServiceContentController@comaSave');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/long_story', function () {
    $service_contents = ServiceContent::orderBy('c_id', 'asc')->get();
    return view('long_story', [
        'service_contents' => $service_contents
    ]);
});
