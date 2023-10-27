<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
        /*public function index(Post $post)
    {
          //return $post->get();
        return view('posts.index')->with(['posts'=>$post->get()]);
        //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }*/
    public function index(Post $post)
    {
    //return view('posts.index')->with(['posts' => $post->getByLimit()]);
    return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]);
    //getPaginateByLimit()はPost.phpで定義したメソッドです。
    }
    /**
    * 特定IDのpostを表示する
    *
    * @params Object Post // 引数の$postはid=1のPostインスタンス
    * @return Reposnse post view
    */
    public function show(Post $post)
    {
    return view('posts.show')->with(['post' => $post]);
    //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
}