<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    </x-slot>
    <body>
        <h1 class="title">編集画面</h1>
        <div class="content">
        <form action="/posts/{{$post->id}}" method="POST">
            <!--$postは変数、->でその中の記事を特定するためのid値を指定
            <!--Formタグには、action属性とmethod属性を指定します。

action属性
リクエストを送信するURIを定義します。
今回はRESTの思想に則り、リソース（登録するデータ）であるpostsをURIに含めた/postsにします。
method属性
GET・POSTなど、HTTPリクエストのメソッドを指定します。
今回はaction属性同様、RESTの思想に則っているのでPOSTリクエストにします。
上記を踏まえると <form action="/posts" method="POST"></form>となります。

-->
            @csrf
            <!--CSRFトークンフィールド
CSRF（クロス・サイト・リクエスト・フォージェリ）というセキュリティ脅威からアプリケーションを守るために、
LaravelではCSRFトークンと呼ばれるものを発行し、そのトークン情報をリクエスト時に一緒に送信することで、リクエストを検証できるようにしています。
-->
            @method('PUT')
            <!--PUTでリクエストをしたいがFormタグのmethod属性ではサポートされていない
            →POSTを指定した上でFormタグの内側でmethod'PUT'とbladeディレクティブを指定する-->
            <div class="content_title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ $post->title }}"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="update"/>
        </form>
        <div class="back">
            <a href="/posts/{{$post->id}}">back</a>
        </div>
        <!--herfの後に"戻る"を押した後に遷移するリンクを入れる-->
        </div>
    </body>
    </x-app-layout>
</html>