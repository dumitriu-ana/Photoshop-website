
@extends('layouts.clientlayout')
@section('title','Service Guide')
@section('header','Service Guide')
@section('content')

<div class="row caseta SG" style="margin-left: 10px;">
  <br>
  <div class="col-xs-3 SGBUT">

    <button class=""
    style="background-color:#003b99; color:white; width:100px; border-radius:30px;border: none;"
     type="button" name="logout">STEP 1</button>
    <br> <br>
    <button type="button" name="button"> <img src="/img/s1.png" alt="">
      <p>見積もり依頼</p>
     </button>
    <span class="glyphicon glyphicon-play"></span>
    <br> <br>
    <button type="button" name="button"> <img src="/img/s2.png" alt="">
    <p>セルフ見積もり</p> </button>
    <span class="glyphicon glyphicon-play"></span>
  </div>

  <div class="col-xs-3 SGBUT">

    <button class=""
    style="background-color:#003b99; color:white; width:100px; border-radius:30px;border: none;"
    type="button" name="logout">STEP 2</button>
    <br> <br>
    <button type="button" name="button">
      <img src="/img/s3.png" alt="">
      <p>見積もりご確認 </p>
     </button>
    <span class="glyphicon glyphicon-play"></span><!-- nurfvg -->
    <br> <br>
    <button type="button" name="button"> <img src="/img/s4.png" alt="">
    <p>データアップロード</p>
   </button>
    <span class="glyphicon glyphicon-play"></span>
  </div>
  <div class="col-xs-3 SGBUT">

    <button class=""
    style="background-color:#003b99; color:white; width:100px; border-radius:30px;border: none;"
     type="button" name="logout">STEP 3</button>
      <br><br><br>
      <button type="button" name="button"> <img src="/img/s5.png" alt="">
      <p>ご入金<br>(ご発注確定)</p>
    </button>
      <span  class="glyphicon glyphicon-play"></span><!-- nurfvg -->

  </div>
  <div class="col-xs-3 SGBUT">

    <button class=""
    style="background-color:#003b99; color:white; width:100px; border-radius:30px;border: none;"
    type="button" name="logout">STEP 4</button>
      <br><br><br>
      <button type="button" name="button"> <img src="/img/s6.png" alt="">
      <p>納品</p>
     </button>
  </div>
  </div>
  <div class="row caseta" style="margin-left: 10px; padding-bottom: 175px;">
    <br>
    <div class="col-xs-3">
      <p>お見積りの方法には2通りがご <br>
        ざいます。弊社担当者に見積り <br>
        を任せる方法と、セルフ見積り <br>
        のシステムでご自分で見積りを <br>
        出す方法です。まずはセルフ見 <br>
        積りをお試しいただいてみては <br>
        いかがでしょうか。
      </p>
    </div>
    <div class="col-xs-3">
      <p>お見積りの送付後5営業日まで <br>
        発注が可能となります。また、 <br>
        セルフ見積りの後、データを <br>
        アップロードしていただくとご入 <br>
        金画面へとお進み出来ます。
      </p>
    </div>
    <div class="col-xs-3">
      <p>お支払いの方法は、クレジット <br>
        カードによるお支払いのみと <br>
        なっております。サービス料金 <br>
        の表示価格は、税抜き表示と <br>
        なっております。別途、消費税 <br>
        が掛かりますのでご了承くださ <br>
        い。二重発行防止のため、クレ <br>
        ジットカード会社発行の利用明 <br>
        細書をもって領収書とさせてい <br>
        ただいております。
      </p>
    </div>
    <div class="col-xs-3">
      <p>納品ご案内より5営業日までは <br>
        何度でも可能です。6営業日目 <br>
        からはサーバーから削除され <br>
        てしまいますので不可能となり <br>
        ます。
      </p>
      <br> <br>
    </div>

</div>
</div>
@endsection
