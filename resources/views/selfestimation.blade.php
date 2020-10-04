@extends('layouts.clientlayout')
@section('title','セルフ見積り')
@section('header','セルフ見積り')
@section('content')

<script type="text/javascript">
    var ratetable = [];
    ratetable['normal'] = {!! $ratetable->normal[0]; !!};

    ratetable['types'] = [];
    ratetable['types']['a'] = {!! $ratetable->types->a; !!};
    ratetable['types']['b'] = {!! $ratetable->types->b; !!};
    ratetable['types']['c'] = {!! $ratetable->types->c; !!};
</script>

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
        <span class="glyphicon glyphicon-play"></span>
        <!-- nurfvg -->
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
        <span class="glyphicon glyphicon-play"></span>
        <!-- nurfvg -->
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
        <button class="NOR" type="button" name="button" style="height: 120px;">
            <img src="/img/s5.png" alt="" style="float: none; width:100%;">
            <p>ご入金<br>(ご発注確定)</p>
        </button>
        <span class="glyphicon glyphicon-play" style="margin-top: 40px;"></span>
        <!-- nurfvg -->

    </div>
    <div class="col-xs-3">

        <button class="" style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 4</button>
        <br><br>
        <button class="NOR" type="button" name="button" style="height: 120px;">
            <img src="/img/s6.png" alt="" style="float: none; width:100%;">
            <p>納品</p>
        </button>
    </div>

</div>
<form action="/client/auto-estimation" method="post" enctype="multipart/form-data">
    @csrf

    <input type="text" name="username" value="{!! $username !!}" style="display: none;">

    <div class="row caseta SG" style="margin-left: 10px;">
        <br><br>

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

        <div class="col-xs-3" style="text-align: right">
            <p>要望、注意事項記入欄:</p>
        </div>

        <div class="col-xs-9">
            <textarea name="notes" style="min-width: 90% !important;" cols="80" required></textarea>
        </div>

        <br>
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
    </div>
    <div class="row caseta steps" style="margin-left: 10px; padding-left: 80px; padding-right: 80px; padding-top: 20px;">
        <center>
            <table class="SE" style="margin-bottom: 20px;">
                <tbody>
                    <tr>
                        <td><span class="glyphicon glyphicon-chevron-right"></span>◆通常ランク</td>
                        <td> <input type="number" id="normal" value="0" min="0" onchange="calculate_price();"> </td>
                        <td>x 240 (手順 1-20)</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-chevron-right"></span>A ランク</td>
                        <td><input type="number" id="type-a" value="0" min="0" onchange="calculate_price();"></td>
                        <td>x 500 (手順 21-70)</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-chevron-right"></span>B ランク</td>
                        <td><input type="number" id="type-b" value="0" min="0" onchange="calculate_price();"></td>
                        <td>x 1000 (手順 71-200)</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-chevron-right"></span>C ランク</td>
                        <td><input type="number" id="type-c" value="0" min="0" onchange="calculate_price();"></td>
                        <td>x 1500 (手順 200+)</td>
                        <td> <button style="background-color:#8e9094; margin-left:30px; border:none; color:white;" type="calc" name="calc">お試し計算</button> </td>
                    </tr>
                </tbody>
            </table>
        </center>
        <hr style="padding:3px; margin:3px; border-color:#6d6e73;">
        <div class="alin">
            <div class="col-xs-6">
                <p>画像点数: <span id="nr_imgs">0</span>
                  <input type="number" name="nr-img" id="nr_imgs_input" value="0" style="display: none;">
                </p>
                <p>セルフ見積もり割引５％  </p>
            </div>
            <div class="col-xs-6">
                <p>価格: <span id="price">0</span>
                  <input type="number" name="price" id="price-input" value="0" min="0" style="display: none;">
                  (手順 <span id="min_steps">0</span><span id="max_steps"></span>)</p>
                <p>---> <span id="discount">0</span></p>
            </div>
            <hr style="padding:3px; margin:3px; border-color:#6d6e73;">
            <div class="col-xs-6">
                <p>合計: </p>
            </div>
            <div class="col-xs-2">
                <p><span id="final_price">0</span></p>
            </div>
            <div class="col-xs-4">
                <p>※価格はすべて消費税抜きの価格となります。</p>
            </div>
        </div>
    </div>
    <div class="row caseta" style="margin-left: 10px;">
        <br>
        <div class="col-xs-9 col-xs-offset-3">
            この内容を添付して見積り依頼へ進む方はこちら
            <input class="btn"
            style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;"
            type="submit" name="submit" value="見積り依頼">
            <br> <br>
        </div>
    </div>
</form>

<script type="text/javascript">
function calculate_price(){

  var normal = parseInt($('#normal').val());
  var a = parseInt($('#type-a').val());
  var b = parseInt($('#type-b').val());
  var c = parseInt($('#type-c').val());

  var img_nr = normal+a+b+c;
  $('#nr_imgs').html(String(img_nr));
  $('#nr_imgs_input').val(String(img_nr));
  var totalPrice = normal*ratetable['normal']+
                    a*ratetable['types']['a']+
                    b*ratetable['types']['b']+
                    c*ratetable['types']['c'];

  var discount = 5/100*totalPrice;

  $('#price').html(String(totalPrice));
  $('#discount').html(String(discount));

  var minSteps = 0;
  var maxSteps = 0;

  minSteps = normal*1+
              a*21+
              b*71+
              c*201;

  maxSteps = normal*20+
              a*70+
              b*200+
              c*201;

  $('#min_steps').html(String(minSteps));
  if(minSteps==0){
    $('#max_steps').html('');
  }else{
    $('#max_steps').html('-'+String(maxSteps));
  }

  totalPrice-=discount;

  $('#final_price').html(String(totalPrice));
  $('#price-input').val(totalPrice);
}
</script>
@endsection
