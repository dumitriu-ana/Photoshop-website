@extends('layouts.baselayout')

@section('title', '会員登録')
@section('header', '会員登録')

@section('content')
<br><br>
<center>
  <form class="form-inline" action="/register" method="post" style="font-size: 20px;">
    @csrf
    <div class="col-xs-3">
      <label for="username">お名前</label>
    </div>

    <div class="col-xs-9">
      <input class="form-control" type="text" required
      id="username" name="username" placeholder="username" style="font-size: 20px;">
    </div>

  <br><br>

  <div class="col-xs-3">
    <label for="mail">メールアドレス</label>
  </div>

  <div class="col-xs-9">
    <input class="form-control" type="text" id="mail"
     name="mail" placeholder="mail adress" required  style="font-size: 20px;">
  </div>
  <br><br>

  <div class="terms" style="margin-left: 25px; margin-right: 25px;">
    <p>メールによる本人確認(メール認証)が必要です。
        メールアドレスを入力して送信ボタンをクリックすると本登録画面のURLをご案内するメールが届きます。
        メールに記載されているURLの有効期限は30分となっていますのでご注意ください。
        また、事前に1313.co.jpからのドメイン着信許可の設定をお願いいたします。</p>
  </div>
  <br>
  <input class="btn btn-sm" type="submit" name="register" value="送信" style="font-size: 20px;">
</form>
<br>
<a class="btn" style="width:200px; background-color: #003b99; color:white; border:none; border-radius:30px; font-size: 20px;"href="/login"
 type="button" name="button">ログイン</a>
</center>
@endsection
