@extends('layouts.clientlayout')

@section('title', '発注画面')
@section('header', '発注画面')

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
        <button class="NOR" type="button" name="button" style="height: 140px;">
            <img src="/img/s5.png" alt="" style="float: none; width:100%;">
            <p>ご入金<br>(ご発注確定)</p>
        </button>
        <span class="glyphicon glyphicon-play" style="margin-top: 40px;"></span><!-- nurfvg -->

    </div>
    <div class="col-xs-3">

        <button class="" style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 4</button>
        <br><br>
        <button class="NOR" type="button" name="button" style="height: 140px;">
            <img src="/img/s6.png" alt="" style="float: none; width:100%;">
            <p>納品</p>
        </button>
    </div>

</div>

<form action="/client/new-order-estimation" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row caseta SG" style="margin-left: 10px;">
        <br>
        <div class="row">
            <div class="col-xs-3">
                <p style="text-align:right;">ユーザー名</p>
            </div>
            <div class="col-xs-9">
                <input class="form-control" type="text" readonly id="username" name="username" value="{!! $username !!}">
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3">
                <p style="text-align:right;">画像点数</p>
            </div>
            <div class="col-xs-9">
                <input class="form-control" type="number" name="nr-img" value="0" min="0"> <br>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3">
                <p style="text-align:right;">原稿データ選択</p>
            </div>
            <div class="col-xs-9">
                <input type="checkbox" name="data_sel" value="data_sel" required>
                <span style="color:red;">※原稿データはフォルダーにまとめ、 zip 圧縮をかけてから選択してください。</span>

                <input type="file" class="upload-zip" name="upload-zip" style="display: none;" value="" accept=".zip" required>

                <button class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;" type="button" onclick="
        $('.upload-zip').trigger('click');
      ">アップロード</button>

            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-3">
                <p style="text-align:right;">要望、注意事項記入欄</p>
            </div>
            <div class="col-xs-9">
                <textarea class="form-control" name="notes" placeholder="notes" required></textarea>
                <br>
            </div>
        </div>
        <br>

        <br>

        <div class="">
            <div class="col-xs-3">
                <p style="text-align:right;">無料オプション選択</p>
            </div>
            <div class="col-xs-9">
                <input type="checkbox" name="format" onclick="
      if(this.checked){
        $('.extensions').fadeIn(250);
      }else{
        $('.extensions').fadeOut(250);
      }
      ">ファイル形式変換

                <span class="extensions" style="display: none;">
                    <input style="margin-left:15px;" type="radio" name="extension" value="jpeg">JPEG
                    <input style="margin-left:10px;" type="radio" name="extension" value="tiff">TIFF
                    <input style="margin-left:10px;" type="radio" name="extension" value="eps">EPS
                    <input style="margin-left:10px;" type="radio" name="extension" value="psd">PSD
                </span>

                <br>
                <input type="checkbox" name="backgr">背景色の処理
                <br>
                <input type="checkbox" name="eps">クリッピングパス設定 (EPS 納品時のみ)
                <br>
                <input type="checkbox" name="resolution" onchange="
        if(this.checked){
          $('.res-opt').fadeIn(250);
        }else{
          $('.res-opt').fadeOut(250);
        }
      ">解像度変更
                <span class="res-opt" style="display: none;">
                    <input type="number" name="resX" placeholder="X" value="1280" style="width: 75px !important">
                    x
                    <input type="number" name="resY" placeholder="Y" value="1080" style="width: 75px !important">
                </span>
                <br>
                <input type="checkbox" name="color-format" value="">RGB → CMYK 変換
            </div>
        </div>
        <br> <br>
        <div>
            <div class="col-xs-3">
              <button class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px; float: right;"
                         type="button" name="ratetable" onclick="
              window.open('/client/ratetable', '_blank');
              ">金額案内</button>
            </div>
            <div class="col-xs-9">
                <button class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;"
                 type="button" name="autoestim" onclick="
      window.location = '/client/auto-estimation';
      ">セルフ見積りへ</button>
                <br> <br>
                <p>※セルフ見積りを行ってから見積り依頼を行うと 5% 割引となります。</p>
            </div>
        </div>
        <br><br>
        <center>
            <input class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;" type="submit" name="submit" value="見積り依頼">
        </center>
        <br><br>

    </div>
</form>

@endsection
