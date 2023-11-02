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

//Route::get('/posts', [Postcontroller::class, 'index']);

/*Route::get('/', function() {
    return view('posts.index');
});*/
//スラッシュというリクエストが来たらposts.index、つまりindex.blade.phpを返す
//view('posts.index')はpostsディレクトリ下のindex
//viewを返却するときはreturn内をview('bladeファイル内の.bladeの前の部分')と書く
//bladeファイルがposts直下にないときはviews以降の相対パスを書く

Route::get('/', [Postcontroller::class, 'index']);
Route::get('/posts/create',[Postcontroller::class, 'create']);
//必ずRoute::get('/posts/{post}', 'PostController@show');の上に書くようにしてください。web.phpは上からルーティングを見ていき、当てはまるルーティングのものが呼び出されます。先にRoute::get('/posts/{post}', 'PostController@show');を書くと{post}のところにcreateという文字列が入ってしまい、showメソッドが呼び出されるという予期しない挙動になるので気をつけましょう。
Route::get('/posts/{post}', [Postcontroller::class ,'show']);
// '/posts/{対象データのID}'にGetリクエストが来たら、Postcontrollerのshowメソッドを実行する
