@extends('layouts.logout')

@section('content')

{!! Form::open() !!}
<div class="mt-4 ">
    <h2>新規ユーザー登録</h2>

    @if ($errors->any())
        <div class="col alert alert-danger" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
        <div class="mt-3 p-3 border" style="background-color: rgba(0,0,255,0.1);" class="rounded">
            <div class="mt-3 text-left">
                {{ Form::label('ユーザー名') }}<br>
            </div>
            {{ Form::text('username',null,['class' => 'input']) }}<br>
            @if($errors->has('username'))
            {{ $errors->first('username') }}
            @endif
            <div class="mt-3 text-left">
                {{ Form::label('メールアドレス') }}<br>
            </div>
            {{ Form::text('mail',null,['class' => 'input']) }}<br>
            <div class="mt-3 text-left">
                {{ Form::label('パスワード') }}<br>
            </div>
            {{ Form::password('password',null,['class' => 'input']) }}<br>
            <div class="mt-3 text-left">
                {{ Form::label('パスワード確認') }}<br>
            </div>
            {{ Form::password('password_confirmation',null,['class' => 'input']) }}<br>
            <div class="mt-2 text-right">
                {{ Form::submit('登録',['class' => 'btn btn-primary', 'onfocus' => 'this.blur();' ]) }}
            </div>
            <div class="mt-2">
                <p><a href="/login">ログイン画面へ戻る</a></p>
            </div>
        </div>
</div>



{!! Form::close() !!}


@endsection
