@extends('layouts.login')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="mt-5 mb-5 ml-5 pl-5">
        <div class="d-flex">
          <form action="/search">
            {{ csrf_field() }}
              <!-- 任意の<input>要素＝入力欄などを用意する -->
              <input type="text" name="word" placeholder="ユーザー名">
               <!-- 送信ボタンを用意する -->
              <button><a href="/"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
              <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/></svg></a></button>
          </form>
        @if(isset($word))
          <div class="ml-3 mt-2 d-flex">
            <p>検索ワード:　{{ $word }}</p>
          </div>
        @endif
        </div>

    </div>

    <div id="user" class="border-top border-danger">
      @foreach ($users as $user)
        @if(!(Auth::user()->id==$user->id))
        <div class="row">
          <div class="col ml-5 pl-5 d-flex" id="follow_pare">
              <div class="w-200 mr-5 pr-5 d-flex">
                  <div class="p-3 d-flex">
                    @if( $user->image  == '/images/dawn.png')
                      <img src="{{ $user->image }}">
                    @else
                      <img src= "{{ asset('storage/uploads/' .$user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                    @endif
                    <div class="ml-2 mt-3">
                      <p class="mb-0"><span class="font-weight-bold">{{ $user->username }}</span></p>
                    </div>
                  </div>

              </div>

              <div class="mt-4 ml-5 pl-5" id="follow_ko">
                  @if (Auth::user()->isFollowing($user->id))
                      <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}

                          <button type="submit" class="btn btn-danger">フォロー解除</button>
                      </form>
                  @else
                      <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                          {{ csrf_field() }}

                          <button type="submit" class="btn btn-primary">フォローする</button>
                      </form>
                  @endif
              </div>
          </div>
        </div>
        @endif
      @endforeach
    </div>
  </div>
</div>


@endsection
