<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postcontroller;
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



//Route::get('/posts', [PostController::class, 'index']);
/*Route::get('/', function() {
    return view('posts.index');
});*/
//スラッシュというリクエストが来たらposts.index、つまりindex.blade.phpを返す
//view('posts.index')はpostsディレクトリ下のindex
//viewを返却するときはreturn内をview('bladeファイル内の.bladeの前の部分')と書く
//bladeファイルがposts直下にないときはviews以降の相対パスを書く
Route::get('/', [PostController::class, 'index']);

