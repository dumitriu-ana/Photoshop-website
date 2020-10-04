@extends('layouts.baselayout')

@section('title', 'ログイン')
@section('header', 'ログイン')

@section('dependencies')
@parent
  <script type="text/javascript">
    $(document).ready(function(){
      $('.calendar').pignoseCalendar({
        lang: 'jp',
        pickWeeks: false,
        initialize: true,
        multiple: false,
        toggle: false,
        buttons: false,
        reverse: false,
        modal: false,
        buttons: false,
        minDate: null,
        maxDate: null,
        select: function (){},
        selectOver: false,
        apply: function (){},
        click: null
      });
    });
  </script>
@endsection

@section('content')

<br><br>
<div class="col-xs-5 col-xs-offset-1">

  <a href="/register"
   type="button" name="button">会員登録がお済みでない方はログイン出来ません。
      こちらより会員登録をお済ませください。</a><br><br>
   <form action="/login" method="post">
  @csrf
  <div class="form-group">
    <label for="mail">切り抜きブリッジID(メールアドレス)</label>
    <input class="form-control"  style="width:100% !important;" type="text" id="mail" name="username" placeholder="Username or mail address" required>
  </div>
  <div class="form-group">
    <label for="password">パスワード (入力されたPW)</label>
    <input class="form-control"  style="width:100% !important;" type="password" id="password" name="password" placeholder="password" required>
  </div>
  <br><br>
  <center>
  <input type="checkbox" name="save-pass" value="">ログイン情報を記録する(7日間)
  <br> <br>
  <input class="btn btn-sm" type="submit" name="register" value="ログイン">
</form>

<br><br>
<a href="/forgot-password">パスワードをお忘れの方はこちら</a>
</center>
<br> <br>

</div>

<div class="col-xs-5 col-xs-offset-1">
  <div class="calendar"></div>
</div>

@endsection
