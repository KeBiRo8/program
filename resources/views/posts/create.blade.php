<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
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
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
        </div>
    </body>
</html>