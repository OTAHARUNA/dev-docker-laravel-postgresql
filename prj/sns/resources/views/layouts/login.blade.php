<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title>SNS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/login.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="/images/main_logo_mini.png" sizes="16x16" type="image/png" />
    <link rel="icon" href="/images/main_logo_mini.png" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <div id="container" style="display:grid;">
        <div class="row">
            <div class="col-lg-12">
                <header style="background:##B384FF;">
                    <div id="head">
                        <h1 id="header-logo"><a href="/top"><img id="header-logo" src="/images/main_logo.png"></a></h1>

                        <div id="menu" class="">
                            <div class="" id="accordion_menu">
                                <div class="d-flex">
                                    <div class="mr-4 mt-2">
                                        <a data-toggle="collapse" href="#links" aria-controls="#links" id="name" class="text-white">{{ Auth::user()->username }}さん</a>
                                    </div>
                                    <div class="mr-2">
                                        @if( Auth::user()->image == '/images/dawn.png')
                                        <img src="{{ Auth::user()->image }}">
                                        @else
                                        <img src="{{ asset('/storage/uploads/'.auth()->user()->image) }}" alt="" class="rounded-circle" width="50" height="50">
                                        @endif
                                    </div>
                                </div>

                                <ul id="links" class="collapse bg-white">
                                    <li><a href="/top">ホーム</a></li>
                                    <li><a href="/profile">プロフィール</a></li>
                                    <li><a href="{{ route('logout')}}">ログアウト</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

        </div>
        <div class="row justify-content-between" style="height: 100vh;">
            <div class="col-10">
                @yield('content')
            </div>


            <div class="col-2" id="sidebar">
                <div id="confirm">
                    <p class="mt-2"><span class="font-weight-bold">{{ Auth::user()->username }}さんの</span></p>
                    <div class="text-right">
                        <div class="count pt-3 d-flex">
                            <p>フォロー数</p>
                            <p class="pl-4 pb-2">{{Auth::user()->followings()->get()->count()}}名</p>
                        </div>
                        <p class="btn"><button id="list_button"><a href="/follow-list">フォローリスト</a></button></p>
                        <div class="count d-flex">
                            <p>フォロワー数</p>
                            <p class="pl-2 pb-2">{{Auth::user()->followers()->get()->count()}}名</p>
                        </div>
                        <p class="btn"><button id="list_button"><a href="/follower-list">フォロワーリスト</a></button></p>
                        <p class="mt-5"><button id="list_button" class="mx-auto"><a href="/search">ユーザー検索</a></button></p>
                    </div>

                </div>

            </div>

        </div>

    </div>



    <footer>
    </footer>

    <script src="JavaScriptファイルのURL"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
