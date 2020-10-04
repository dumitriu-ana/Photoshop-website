@extends('layouts.baselayout')

@section('title', '会員登録')
@section('header', '会員登録')

@section('content')

<br><br>
<center><form class="form-inline" action="{!! $_SERVER['PHP_SELF'] !!}" method="post">
  @csrf
  <div class="form-group">
    <div class="col-xs-3">
    <label for="mail">メールアドレス</label>
  </div>
  <div class="col-xs-9">
    <input class="form-control" type="text" id="mail" name="mail"
    placeholder="mail adress" value="{!! $mail !!}" required readonly>
    </div>
  </div>
  <br><br>

  <div class="form-group">
    <div class="col-xs-3">
      <label for="username">お名前</label>
    </div>
  <div class="col-xs-9">
    <input class="form-control" type="text" id="username" name="username"
    placeholder="username" value="{!! $username !!}" required readonly>
    </div>
  </div>

  <br><br>

  <div class="form-group">
    <div class="col-xs-3">
    <label for="password">パスワード</label>
    </div>
  <div class="col-xs-9">
    <input class="form-control" type="password" id="password"
    name="password" placeholder="password" pattern=".{8,}" required title="8 characters minimum">
    <p>*8文字以上、欧文(大文字、小文字)と数字を組み合わせ</p>
    </div>
  </div>
  <br><br>
  <input type="checkbox" name="accept" value="" required><a href="/terms">利用規約</a> に同意する
  <br> <br>
  <input class="btn btn-sm" type="submit" name="register" value="登録">
</form>
</center>

@endsection
