@extends('layouts.logout')

@section('content')

<div class="mt-5 p-3 border" style="background-color: rgba(0,0,255,0.1);" class="rounded">
  <div id="clear">
    <div class="mt-3">
    <div class="mb-2">
      <p class="font-weight-bold mb-2">{{ old('username') }}さん、</p>
      <p>ようこそ！DAWNSNSへ！</p>
    </div>

      <div class="mt-5">
        <div class="m-2">
          <p>ユーザー登録が完了しました。</p>
        </div>
        <p>さっそく、ログインをしてみましょう。</p>
        <div class="m-4">
            <a href="/login"><button type="button" class="btn btn-primary">ログイン画面へ</button></a>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
