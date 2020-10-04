@extends('layouts.clientlayout')
@section('title', 'Order Completion')
@section('header','Order Completion')

@section ('dependencies')
@parent
<iframe id="donload_iframe" style="display:none;"></iframe>

<script type="text/javascript">
function Download(url) {
    document.getElementById('donload_iframe').src = url;
};
</script>

@endsection

@section('content')


<div class="row caseta steps" style="margin-left: 10px;">
    <br>
    <div class="col-xs-3">

        <button class="" style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 1</button>
        <br> <br>
        <button class="NOR" type="button" name="button">
            <div class="center">
                <img src="/img/s1.png" alt="">
                <p>見積もり依頼</p>
            </div>
        </button>
        <span class="glyphicon glyphicon-play"></span><!-- nurfvg -->
        <br> <br>
        <button class="NOR" type="button" name="button">
            <div class="center">
                <img src="/img/s2.png" alt="">
                <p>セルフ見積もり</p>
            </div>
        </button>
        <span class="glyphicon glyphicon-play"></span>
    </div>

    <div class="col-xs-3">

        <button class="" style="background-color:#003b99; color:white; border:none; width:80% !important; width:100px; border-radius:30px;" type="button" name="logout">STEP 2</button>
        <br> <br>
        <button class="NOR" type="button" name="button">
            <div class="center">
                <img src="/img/s3.png" alt="">
                <p>見積もりご確認</p>
            </div>
        </button>
        <span class="glyphicon glyphicon-play"></span><!-- nurfvg -->
        <br> <br>
        <button class="NOR" type="button" name="button">
            <div class="center">
                <img src="/img/s4.png" alt="">
                <p>データアップロード</p>
            </div>
        </button>
        <span class="glyphicon glyphicon-play"></span>
    </div>
    <div class="col-xs-3">

        <button class="" style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 3</button>
        <br><br>
        <button class="NOR" type="button" name="button" style="height: 92px;">
            <img src="/img/s5.png" alt="" style="float: none; width:100%;">
            <p>ご入金<br>(ご発注確定)</p>
        </button>
        <span class="glyphicon glyphicon-play" style="margin-top: 40px;"></span><!-- nurfvg -->

    </div>
    <div class="col-xs-3">

        <button class="" style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 4</button>
        <br><br>
        <button class="NOR" type="button" name="button" style="height: 92px;">
            <img src="/img/s6.png" alt="" style="float: none; width:100%;">
            <p>Delivery</p>
        </button>
    </div>


</div>

<div class="row caseta steps" style="margin-left: 10px;">
    <br><br>
    <div class="ordert">
        <center>
            <h3>ご発注ありがとうございます。</h3>
            <p><b>決済会社からの支払い明細が領収書となりますので、保管するようお願いいたします。
                  これより作業に移ります。作業完了後に通知のメールが届きますでのでよろしくお願いいたします。</b></p>

            <br>

            <button type="button" name="button" class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;"
            onclick="
              Download('/files/users/{!! $order->customer_username !!}/order_complete{!! $order->id !!}.zip');
            ">Download project</button>
        </center>
    </div>
    <center>
        <iframe style="display: none;" src="" id="receipt-canvas"></iframe>
        <button class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;" type="button" name="download_receipt"
        onclick="
          $('#receipt-canvas').attr('src', '/client/get-order-receipt?id={!! $order->id !!}')
        ">Download receipt</button>

        <button class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;" type="button" name="send_estim"
        onclick="window.location = '/clear-all';">Log out</button>
    </center>
    <br><br> <br>
</div>

@endsection
