@extends('layouts.clientlayout')
@section('title', 'ホーム')
@section('header','ホーム')
@section('content')

<div class="row caseta" style="margin-left: 10px;">
<div class="">
  <h1 style="font-size: 60px; margin-left: 35px;">ようこそ</h1>
  <center><h1 style="font-size:115px;">切り抜き<span style="color:#003b99;">ブリッジ</span><span style="font-size:60px;">へ</span></h1>
  <h2> <span style="color:#003b99;font-size: 50px;" >是非、皆さまのお仕事にご利用ください。</span></h2></center>
</div>
  <br>
  <div class="row">
    <center>
      <button type="button" class="btn btn-primary big_button"
      onclick="window.location = '/client/service-guide';"
      >サービス流れ</button>
      <button type="button" class="btn btn-primary big_button"
      onclick="window.location = '/client/new-order-estimation';"
      >新規オーダー見積もり依頼 </button>
      <button type="button" class="btn btn-primary big_button"
      onclick="window.location = '/client/order-list';"
      >オーダーリスト</button>


      @if($free_trials>0)
      <button type="button" class="btn btn-primary big_button"
      onclick="window.location = '/client/free-trial';"
      >無料トライアル</button>
      @endif

      <button type="button" class="btn btn-primary big_button"
      onclick="window.location = '/client/profile';"
      >アカウント情報</button>

      @if($admin)
      <button type="button" class="btn btn-primary big_button"
      onclick="window.location = '/manager';"
      >管理</button>
      @endif
      <br><br>
      <img style="width:12vw;" src="img/logo1.png" alt="">
      <br> <br> <br>
    </center>
  </div>
</div>
@endsection
