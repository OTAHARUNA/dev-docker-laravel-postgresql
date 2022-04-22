@extends('layouts.login')

@section('content')

<div class="">
    <div class="">
        <div class="" id="border">
            <div class="">
                <div class="d-inline-flex">
                    <div class="">
                        <div class="m-5 d-flex">
                            @if( $myuser->image == '/images/dawn.png')
                            <img src="{{ $myuser->image }}" width="50" height="50">
                            @else
                            <img src="{{ asset('/storage/uploads/' .$myuser->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="col">
                                <div class="d-flex">
                                    <div class="ml-3">
                                        <p class="m-2">Name</p>
                                    </div>
                                    <div class="ml-3">
                                        <p class="m-2"><span class="font-weight-bold">{{ $myuser->username }}</span></p>
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="ml-3">
                                        <p class="m-2">Bio</p>
                                    </div>
                                    <div class="ml-3">
                                        <p class="m-2">{{ $myuser->bio }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ml-5 pl-5">
                        <div class="mt-5 ml-5 pt-5 pl-5 d-flex">
                            <div class="ml-5">
                                @if (Auth::user()->isFollowing($myuser->id))
                                <form action="{{ route('unfollow', ['id' => $myuser->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                                </form>
                                @else
                                <form action="{{ route('follow', ['id' => $myuser->id]) }}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </form>
                                @endif

                                @if (Auth::user()->isFollowed($myuser->id))
                                <div class="mt-2">
                                    <span>フォローされています</span>
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (isset($timelines))
        @foreach ($timelines as $timeline)
        <div class="border-bottom border-danger">
            <div class="m-2 d-flex">
                @if( $timeline->user->image == '/images/dawn.png')
                <img src="{{ $timeline->user->image }}" width="50" height="50">
                @else
                <img src="{{ asset('/storage/uploads/' .$timeline->user->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
                @endif
                <div class="col">
                    <div class="d-flex">
                        <div>
                            <p class="m-2"><span class="font-weight-bold">{{ $timeline->user->username }}</span></p>
                        </div>
                        <div class="col clearfix">
                            <div class="float-right">
                                <p id='time' class="small mt-2">{{ $timeline->created_at }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex m-2">
                        <p class="">{{ $timeline->posts }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p>投稿はまだありません</p>
        @endif
    </div>
</div>




@endsection
