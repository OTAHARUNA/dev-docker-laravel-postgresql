@extends('layouts.login')

@section('content')

<div class="container">
    <div class=''>
        <div class='mt-5 ml-5'>
            @if( Auth::user()->image == '/images/dawn.png')
            <img src="{{ Auth::user()->image }}">
            @else
            <img src="{{ asset('storage/uploads/' .auth()->user()->image) }}" alt="dawn.sns" class="rounded-circle" width="50" height="50">
            @endif
        </div>
    </div>

    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ユーザ編集</div>
                    @if ($errors->any())
                    <div class="col alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-body" class="mx-auto">
                        <!-- 重要な箇所ここから -->
                        <form action="{{ route('users.update', Auth::user()->id) }}" enctype="multipart/form-data" method=post>
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">UserName</label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Mail Adress</label>
                                <div class="col-sm-6">
                                    <input type="text" name="mail" value="{{ Auth::user()->mail }}" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Now Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="nowpassword" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="newpassword" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="newpassword_confirmation" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">bio</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bio" value="{{ Auth::user()->bio }}" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Icon Image</label>
                                <div class="col-sm-6">
                                    <input type="file" name="image" class="" autocomplete="image" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="float-right btn btn-primary">更新</button>
                        </form>
                        <!-- 重要な箇所ここまで -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
