@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div class="mt-3 pt-3">
    <p class="h6">DAWNSNSへようこそ</p>
    <div class="mt-3 p-3 border" style="background-color: rgba(0,0,255,0.1);" class="rounded">
        <div class="mt-3 text-left">
              {{ Form::label('e-mail') }}<br>
        </div>
            {{ Form::text('mail',null,['class' => 'input']) }}<br>
        <div class="mt-3 text-left">
            {{ Form::label('password') }}<br>
        </div>
            {{ Form::password('password',['class' => 'input']) }}<br>
        <div class="mt-2 text-right">
            {{ Form::submit('LOGIN',['class' => 'btn btn-primary', 'onfocus' => 'this.blur();' ]) }}
        </div>
        <div class="mt-2">
            <p><a href="/register">新規ユーザーの方はこちら</a></p>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
