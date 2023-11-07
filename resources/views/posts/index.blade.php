<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!--str_replaceは検索文字列と一致した文字列を置換する-->
    <x-app-layout>
    <x-slot name="header">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    </x-slot>
    <body class="antialiased">
        <h1>Blog Name</h1>
        <div class='posts'><!--divはh1やh2をまとめる機能、div classはその名前-->
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        <!--id以降は$postのidをformのidの中に埋め込む、formタグではdeleteを指定できないのでmethodでpost-->
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    <!--デリートボタン実装、typeをsubmitにすると送信されてしまう、
                    onclickは要素をクリックしたときにその後ろの関数を使用する-->
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
            <!--linksは残りの結果のページのリンクをレンダーする。-->
        </div>
        <a>ログインユーザー:{{ Auth::user()->name }}</a>
    </body>
    </x-app-layout>
    <a href='/posts/create'>create</a>
    <script>
    //JavaScript指定
        function deletePost(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                //confirm関数は引数に書いた文字列がポップアップで出てくる関数
                document.getElementById(`form_${id}`).submit();
                //getElementByIdでhtmlの要素を取得今回はform_id
                //Java Scriptでは変数の埋め込みができない→delete_post内のidを引数に
                //JSではバッククォーテーション``の中で変数を${}で囲むことで文字列中で変数を使える
            }
        }
    </script>
</html>