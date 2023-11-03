<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\HTTP\Request;

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
    return view('posts.index')->with(['posts' => $post->getPaginateByLimit(5)]);
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
    public function store(Post $post, PostRequest $request)
    //$をつけると$postという変数になる
    /*{
        dd($request->all());
    }*/
    {
        $input = $request['post'];
        //post[~]というもののみを取得し$inputに保存
        $post->fill($input)->save();
        //$postのプロパティを受け取ったデータで上書き
        return redirect('/post/'.$post->id);
        //$post->idを引数に入れることで、作製した投稿の詳細ページへ画面を遷移させることができる
    }
    public function edit(Post $post)
    //引数はPostだが、URLから渡ってきたidを用いてインスタンス化した$post
    {
        return view('posts.edit')->with(['post'=>$post]);
        //posts/editのビュー画面に$postのidをもつ投稿内容を表示させる
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();

        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    //このままPost.phpを変更しない場合物理削除になる
}
