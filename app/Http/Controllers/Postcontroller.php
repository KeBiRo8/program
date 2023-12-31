<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\HTTP\Request;
use App\Models\Category;

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
        $client = new \GuzzleHttp\Client();
        // クライアントインスタンス生成
        $url =  'https://teratail.com/api/v1/questions';
        // GET通信するURL
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        // リクエスト送信と返却データの取得
        // Bearerトークンにアクセストークンを指定して認証を行う
        $questions = json_decode($response->getBody(), true);
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
    //return view('posts.index')->with(['posts' => $post->getByLimit()]);
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(5),
            'questions' => $questions['questions'],
            // index bladeに取得したデータを渡す
        ]);
    //getPaginateByLimit()はPost.phpで定義したメソッドです。
    }
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    //return view('posts.show')->with(['post' => $post]);
 //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
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
