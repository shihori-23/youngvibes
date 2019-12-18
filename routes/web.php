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

Route::get('/', 'ServiceContentController@comaGet');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

