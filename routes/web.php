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
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('top');
});

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
