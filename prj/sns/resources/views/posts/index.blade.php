@extends('layouts.login')

@section('content')

<div class="row">
    <div class="col-12">
        @if (request()->is('*follow-list*'))
        <div class="m-3">
            <p>FOLLOW-LIST</p>
        </div>
        <div class="d-flex">
            @foreach ($users as $user)
            @if(Auth::user()->isFollowing($user->id))
            <form action="{{ route('yourprofile', ['id' => $user->id]) }}">
                {{ csrf_field() }}
                <table>
                    <th>
                    <td class="text-center">
                        <button class="but">
                            @if( $user->image == '/images/dawn.png')
                            <img src="{{ $user->image }}">
                            @else
                            <img src="{{ asset('storage/uploads/' .$user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                            @endif
                        </button>
                        <p class="m-2"><span class="font-weight-bold">{{ $user->username }}</span></p>
                    </td>
                    </th>
                </table>
            </form>
            @endif
            @endforeach
        </div>

        @elseif (request()->is('*follower-list*'))
        <div class="">
            <div class="m-3">
                <p>FOLLOWER-LIST</p>
            </div>

            @foreach ($users as $user)
            @if(Auth::user()->isFollowed($user->id))
            <form action="{{ route('yourprofile', ['id' => $user->id]) }}">
                {{ csrf_field() }}
                <table>
                    <th>
                    <td class="text-center">
                        <button class="but">
                            @if( $user->image == '/images/dawn.png')
                            <img src="{{ $user->image }}">
                            @else
                            <img src="{{ asset('storage/uploads/' .$user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                            @endif
                        </button>
                        <p class="m-2"><span class="font-weight-bold">{{ $user->username }}</span></p>
                    </td>
                    </th>
                </table>
            </form>
            @endif
            @endforeach
        </div>

        @else
        <div id="post-list">
            <div class="post">
                <form method="POST" action="{{ route('posts.store') }}">
                    {{ csrf_field() }}
                    <div class="">
                        <div class="mt-3 mb-3 ml-5">
                            @if( Auth::user()->image == '/images/dawn.png')
                            <img src="{{ Auth::user()->image }}">
                            @else
                            <img src="{{ asset('storage/uploads/' .auth()->user()->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                            @endif
                            <textarea id="post_texts" name="text" required autocomplete="text" rows="3" width="500" maxlength="150" placeholder="今何している？？" class="col-8 pt-2"></textarea>
                            <button class="but"><img src="images/post.png"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>


<div class="row">
    <div class="col-12" id="border-t">
        @if(request()->is('*follow-list*'))
        @foreach ($posts as $post)
        @if(!(Auth::user()->id == $post->user_id))
        <div class="row">
            <div class="col-12 mr-0 border-top border-light" id="border">
                <div class="ml-3 pr-0">
                    <div class="m-3 d-flex">
                        @if( $post->user->image == "/images/dawn.png")
                        <img src="{{ $post->user->image }}" width="50" height="50">
                        @else
                        <img src="{{ asset('storage/uploads/' .$post->user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                        @endif
                        <div class="col">
                            <div class="d-flex">
                                <div>
                                    <p class="m-2"><span class="font-weight-bold">{{ $post->user->username }}</span></p>
                                </div>
                                <div class="col clearfix">
                                    <div class="float-right">
                                        <p id='time' class="small mt-2">{{ $post->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex m-2">
                                <p class="">{{ $post->posts }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach

        @elseif (request()->is('*follower-list*'))
        @foreach ($followers as $follower)
        @if(!(Auth::user()->id == $follower->user_id))
        <div class="row">
            <div class="col-12 mr-0 border-top border-light" id="border">
                <div class="ml-3">
                    <div class="m-2 d-flex">
                        @if( $follower->user->image == '/images/dawn.png')
                        <img src="{{ $follower->user->image }}" width="50" height="50">
                        @else
                        <img src="{{ asset('storage/uploads/' .$follower->user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                        @endif
                        <div class="col">
                            <div class="d-flex">
                                <div>
                                    <p class="m-2"><span class="font-weight-bold">{{ $follower->user->username }}</span></p>
                                </div>
                                <div class="col clearfix">
                                    <div class="float-right">
                                        <p id='time' class="small mt-2">{{ $follower->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex m-2">
                                <p class="">{{ $follower->posts }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif
        @endforeach

        @else
        @foreach ($posts as $post)
        <div class="row">
            <div class="col-12 mr-0 border-top border-light" id="border">
                <div class="border-bottom border-light">
                    <div class="ml-5">
                        <div class="m-2 d-flex">
                            @if( $post->user->image == '/images/dawn.png')
                            <img src="{{ $post->user->image }}" width="50" height="50">
                            @else
                            <img src="{{ asset('/storage/uploads/' .$post->user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="col">
                                <div class="d-flex">
                                    <div>
                                        <p class="m-2"><span class="font-weight-bold">{{ $post->user->username }}</span></p>
                                    </div>
                                    <div class="col clearfix">
                                        <div class="float-right">
                                            <p id='time' class="small mt-2">{{ $post->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex m-2">
                                    <p class="">{{ $post->posts }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ( Auth::user()->id == $post->user_id)
                        <div class="col-12 mx-auto clearfix">
                            <div class="float-right d-flex flex-row m-2 text-center ">
                                <div class="mr-2">
                                    <form action="{{ route('posts.edit', $post->id) }}">
                                        {{ csrf_field() }}
                                        {{method_field('PUT')}}
                                        <div class="modal_wrap">
                                            <input id="trigger" type="checkbox">
                                            <div class="modal_overlay">
                                                <label for="trigger" class="modal_trigger"></label>
                                                <div class="modal_content">
                                                    <label for="trigger" class="close_button">✖️</label>
                                                    <textarea id="post_texts" name='texts' required autocomplete="text" rows="5">{{ old('posts') ?: $post->posts}}</textarea>
                                                    <button><img src="images/edit.png" id="edit"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- モーダルイベント発火元のボタン -->
                                        <label for="trigger" class="open_button"><img src="images/edit.png" id="edit"></label>

                                        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
                                    </form>
                                </div>

                                <div class="">
                                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <div class="buttons">
                                            <p id="trash"><button onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="images/trash.png"></button></p>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

</div>


@endsection
