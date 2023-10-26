<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--str_replaceは検索文字列と一致した文字列を置換する-->
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Blog Name</h1>
        <div class='posts'><!--divはh1やh2をまとめる機能、div classはその名前-->
            @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>{{ $post->title }}</h2>
                <p class='body'>{{ $post->body }}</p>
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
            <!--linksは残りの結果のページのリンクをレンダーする。-->
        </div>
    </body>
</html>