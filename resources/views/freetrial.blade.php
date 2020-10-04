@extends('layouts.clientlayout')
@section('title', '無料トライアル')
@section('header','無料トライアル')
@section('content')

<form action="/client/free-trial" method="post" enctype="multipart/form-data">
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
                <input type="checkbox" name="eps">クリッピングパス設定 (EPS 納品時のみ)y
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

    <div class="row caseta" style="margin-left: 10px;">
        <br>
        <div class="col-xs-9 col-xs-offset-3">
            ※無料トライアルですので料金は掛かりません。
            <input class="btn"
            style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;"
            type="submit" name="submit" value="トライアル">
            <br> <br>
        </div>
    </div>
</form>
@endsection
