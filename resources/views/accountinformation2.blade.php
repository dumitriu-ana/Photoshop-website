@extends('layouts.clientlayout')

@section('title', 'Account information')
@section('header', 'Account information')

@section('content')

<div class="row caseta" style="margin-left:100px; margin-right:100px;">
  <div class="col-xs-12">
    <br>
    <div class="col-xs-4">

      <p style="text-align:right;">お名前</p>
    </div>
    <div class="col-xs-5">
      <p>{!! $username !!}</p>
    </div>
  </div>
  <br> <br>
  <div class="col-xs-12">

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
       type="button" name="button" onclick="window.location = '/client/profile';">edit</button>
    </div>

  </div>
  <br><br>
  <div class="col-xs-12">

    <div class="col-xs-4">
      <p style="text-align:right;">メールアドレス</p>
    </div>
    <div class="col-xs-5">
      <p>{!! $mail !!}</p>
    </div>
    <div class="col-xs-3">
      <button style="border:none; color:white; background-color:black; width:70px;"
      type="button" name="button" onclick="window.location = '/client/modify-mail';">edit</button>
    </div>
    <br>
  </div>
  <br>
  <hr style="border-color:black; width:80%;">



</div>

<div class="row caseta" style="margin-left:100px; margin-right:100px;">
  <div class="" style="margin: 15px;">

    <center>
      <form class="form-inline" action="/client/modify-mail" method="post">
        @csrf
        <div class="form-group">
          <div class="col-lg-3">
            <label for="mail">新しいメールアドレス</label>
          </div>
          <div class="col-lg-9">
            <input class="form-control" type="text" id="mail" name="mail" required
            placeholder="New Mail address">
          </div>
        </div>
        <br><br>

        <div class="form-group">
          <div class="col-lg-3">
            <label for="username">新しいメールアドレス(再入力) </label>
          </div>
          <div class="col-lg-9">
            <input class="form-control" type="text" id="mail" name="mail_verif" required
            placeholder="Confirm New Mail Adress">
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
