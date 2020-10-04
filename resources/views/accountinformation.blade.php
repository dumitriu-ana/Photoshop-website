@extends('layouts.clientlayout')

@section('title', 'アカウント情報')
@section('header', 'アカウント情報')

@section('content')

<div class="row caseta" style="margin-left: 100px; margin-right:100px;">
  <div class="col-xs-8 col-xs-offset-2">
    <br>
    <div class="col-xs-4">

      <p style="text-align:right;">お名前</p>
    </div>
    <div class="col-xs-5">
      <p>{!! $username !!}</p>
    </div>
  </div>
  <br> <br>
  <div class="col-xs-8 col-xs-offset-2">

    <div class="col-xs-4">
      <p style="text-align:right;">パスワード</p>
    </div>
    <div class="col-xs-5">
      <p>
        @for($i = 0; $i < strlen($password); $i++)
        *
        @endfor
      </p>
    </div>
    <div class="col-xs-3">
      <button style="border:none; color:white; background-color:black; width:70px;"
       type="button" name="button" onclick="window.location = '/client/profile';">編集</button>
    </div>

  </div>
  <br><br>
  <div class="col-xs-8 col-xs-offset-2">

    <div class="col-xs-4">
      <p style="text-align:right;">メールアドレス</p>
    </div>
    <div class="col-xs-5">
      <p>{!! $mail !!}</p>
    </div>
    <div class="col-xs-3">
      <button style="border:none; color:white; background-color:black; width:70px;"
      type="button" name="button" onclick="window.location = '/client/modify-mail';">編集</button>
    </div>
    <br>
  </div>
  <br>
  <hr style="border-color:black; width:80%;">



</div>

<div class="row caseta" style="margin-left: 100px; margin-right:100px;">
  <div class="" style="margin: 15px;">

    <center>
      <form class="form-inline" action="/client/profile" method="post">
        @csrf
        <div class="form-group">
          <div class="col-lg-3">
            <label for="mail">現在のパスワード</label>
          </div>
          <div class="col-lg-9">
            <input class="form-control" type="password" required
            id="password" name="actual_password" placeholder="password">
          </div>
        </div>
        <br><br>

        <div class="form-group">
          <div class="col-lg-3">
            <label for="username">新しいパスワード</label>
          </div>
          <div class="col-lg-9">
            <input class="form-control" type="password" required
            id="new_password" name="new_password" placeholder="new password">
          </div>
        </div>

        <br><br>

        <div class="form-group">
          <div class="col-lg-3">
            <label for="password">新しいパスワード(再入力)</label>
          </div>
          <div class="col-lg-9">
            <input class="form-control" type="password" id="confirm_password" required
            name="conf_new_password" placeholder="confirm new password">
          </div>
        </div>
        <br><br>
        <center>
          <input class="btn btn-sm" type="submit" name="submit" value="変更">
        </center>
      </form>
    </center>
  </div>
  <br>
</div>

@endsection
