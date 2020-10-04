@extends('layouts.clientlayout')
@section('title', 'Confirm order')
@section('header','Home')

@section('dependencies')
@parent

<style media="screen">
.loading-fade{
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 999;
}

.loading-fade{
  z-index: 99000;
  display: flex;
  justify-content: center;
  align-items: center;
}

.loading-fade .loading-div{
  position: fixed;
  width: 200px;
  height: 100px;
  background-color: white;
  color: black;
  display: flex;
  justify-content: center;
  align-content: center;
}

</style>

@endsection

@section('content')

<div class="loading-fade" style="display: none;">
  <div class="loading-div">
    <h3>Loading...</h3>
  </div>
</div>

<script type="text/javascript">
  function load(){
    $('.loading-fade').fadeIn(250);
  }

  function unload(){
    $('.loading-fade').fadeOut(250);
  }
</script>

<div class="logout">
    <div class="orderl">
        <p>発注 No. {!! $order->id !!}</p>

        <br>
        <div class="col-xs-10 col-xs-offset-1">
            <div class="col-xs-12">
              要望、注意事項記入欄: <br>
                <textarea name="name" rows="8" style="min-width: 100% !important;" readonly>{!! $order->notes !!}</textarea>
                <br><br>
            </div>

            <div class="col-xs-12">
                無料オプション選択: <br>
                <input type="checkbox" name="format" value="" onclick="return false;"

                @if ($order->format!=NULL)
                checked
                @endif

                >ファイル形式変換

                @if ($order->format!=NULL)

                <input style="margin-left:15px;" type="radio" name="extension" value="" onclick="return false;"

                @if ($order->format=='jpeg')
                checked
                @endif

                >JPEG
                <input style="margin-left:10px;" type="radio" name="extension" value="" onclick="return false;"

                @if ($order->format=='tiff')
                checked
                @endif

                >TIFF
                <input style="margin-left:10px;" type="radio" name="extension" value="" onclick="return false;"

                @if ($order->format=='eps')
                checked
                @endif

                >EPS
                <input style="margin-left:10px;" type="radio" name="extension" value="" onclick="return false;"

                @if ($order->format=='psd')
                checked
                @endif

                >PSD

                @endif

                <br>
                <input type="checkbox" name="backgr" value="" onclick="return false;"

                @if ($order->background==1)
                checked
                @endif

                >背景色の処理
                <br>
                <input type="checkbox" name="eps" value="" onclick="return false;"

                @if ($order->eps==1)
                checked
                @endif

                >クリッピングパス設定 (EPS 納品時のみ)
                <br>
                <input type="checkbox" name="Resolution" value="" onclick="return false;"

                @if ($order->resolution_change==1)
                checked
                @endif

                >解像度変更

                @if ($order->resolution_change==1)
                <br>
                X: <input type="text" name="" value="{!! $order->res_x !!}" readonly><br>
                Y: <input type="text" name="" value="{!! $order->res_y !!}" readonly><br>

                @endif


                <br>
                <input type="checkbox" name="rbg" value="" onclick="return false;"

                @if ($order->rgb_to_cmyk==1)
                checked
                @endif

                >RGB → CMYK 変換
                <br> <br>

                <h3>合計: {!! $order->price !!}</h3>
            </div>
        </div>

        <div class="col-xs-10 col-xs-offset-1">
          <center>
              <button class="btn " style="background-color:#003b99; color:white; width:150px; border-radius:30px; margin-left:25px;" type="button" name="logout"
                onclick="
                  load();
                  var xhttp = new XMLHttpRequest();

                  xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      window.location = '/client/finish-order'
                    }
                  };
                  xhttp.open('GET', '/client/approve-order?id={!! $order->id !!}', true);
                  xhttp.send();
                "
              >発注</button>
              <button class="btn " style="background-color:#7d828a; color:white; width:150px; border-radius:30px; margin-left:25px;" type="button" name="logout"
              onclick="
                load();
                var xhttp = new XMLHttpRequest();

                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    window.location = '/client'
                  }
                };
                xhttp.open('GET', '/client/cancel-order?id={!! $order->id !!}', true);
                xhttp.send();
              "
              >取り消し</button>
          </center>
          <br>
          <p>※発注ボタンを押しますと外部のカード決済画面に移動します。 同時にご発注内容の確認のメールが送信されますので、
              内容に間違いがないかご確認ください。 内容に間違いがある場合は、 決済画面でのお支払いを中止して、 < ・ ・ ・
              @1313.co.jp> までお問い合わせください。</p>
        </div>
    </div>
</div>


<div class="row caseta" style="margin-left: 10px;">
    <div class="" style="margin-left: 15px;">
        <h2>Wellcome</h2>
        <h1>TO <span style="color:#003b99;">CLIPPING BRIDGE</span></h1>
        <h2> <span style="color:#003b99;">Please, use it for your work.</span></h2>
    </div>
    <br>
    <div class="row">
        <center>
            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/client/service-guide';">Service guide</button>
            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/client/new-order-estimation';">New order estimation request </button>
            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/client/order-list';">Order list</button>
            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/client/delivers';">Delivery list</button>

            @if($free_trials>0)
            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/client/free-trial';">Free Trial</button>
            @endif

            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/client/profile';">Account info</button>

            @if($admin)
            <button type="button" class="btn btn-primary big_button" onclick="window.location = '/manager';">Administrator</button>
            @endif
            <br><br>
            <img style="width:12vw;" src="/img/logo1.png" alt="">
            <br> <br> <br>
        </center>
    </div>
</div>
@endsection
