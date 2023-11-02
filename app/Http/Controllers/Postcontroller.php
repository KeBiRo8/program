<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class Postcontroller extends Controller
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
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    //return view('posts.show')->with(['post' => $post]);
 //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    public function create()
    {
    return view('posts.create');
    }
    public function store(Request $request, Post $post)
    //$をつけると$postという変数になる
    /*{
        dd($request->all());
    }*/
    {
        $input = $request['post'];
        //post[~]というもののみを取得し$inputに保存
        $post->fill($input)->save();
        //$postのプロパティを受け取ったデータで上書き
        return redirect('post/'.$post->id);
        //$post->idを引数に入れることで、作製した投稿の詳細ページへ画面を遷移させることができる
    }


}
