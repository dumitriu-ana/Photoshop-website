@extends('admin/layouts/base_layout')

@section('title', 'オーダー状況')
@section('title2', 'オーダー状況')

@section('dependencies')
@parent

<style media="screen">

  tr:hover{
    background-color: #c9c9c9;
    cursor: pointer !important;
  }

  .glyphicon:hover{
    cursor: pointer !important;
  }
</style>

@endsection

<div class="price-fade" style="display: none;">
    <div class="price-content">
        <div class="close-but" onclick="$('.price-fade').fadeOut(250);">
            X
        </div>

        <input type="text" id="price-set-id" name="" value="0" style="display: none;">

        <br><br><br><br><br>
        <center>
            <p>このプロジェクトの価格はいくらですか?</p>
            <input class="form-control" type="number" min="0" name="" value="" id="price-set-value" placeholder="price"><br>
            <textarea name="name" class="form-control" rows="8" style="width: 100%; resize: none;" id="price-set-comment" placeholder="Message for client (optional)"></textarea>
            <br>
            <button type="button" name="button" class="btn" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;" onclick="
        function unload_all(){
          unload();
          $('.price-fade').fadeOut(250);
          window.location = '/manager';
        }

        var value = parseInt($('#price-set-value').val());
        var comment = String($('#price-set-comment').val());

        var req_nr = 2;

        if($('#price-set-value').val().trim() != ''){
          load();
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                req_nr--;

                if(req_nr==0){
                  unload_all();
                }
              }
          };

          xhttp.open('POST', '/manager/set-order-price', true);
          xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
          xhttp.send('id='+String($('#price-set-id').val())+'&value='+String(value));

          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                req_nr--;

                if(req_nr==0){
                  unload_all();
                }
              }
          };
          xhttp.open('POST', '/manager/send-message', true);
          xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhttp.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

          if(comment.trim()!=''){
            xhttp.send('id='+String($('#price-set-id').val())+'&comment='+encodeURIComponent(String(comment)));
          }else{
            xhttp.send('id='+String($('#price-set-id').val()));
          }
        }else{
          alert('Please fill the price textbox.');
        }

      ">Set</button>
        </center>
    </div>
</div>

<div class="order-fade" style="display: none;">
    <div class="order-content">
        <div class="close-but" onclick="$('.order-fade').fadeOut();">
            X
        </div>

        <h1>発注 No. <span id="id_order">0</span></h1>
        <br>
        <p>数量: <span id="img_nr">0</span></p>
        <p>要望、注意事項記入欄: <span id="notes">jkl</span></p>
        <p>ファイル形式変換: <span id="format">Yes &#8594; jpeg</span></p>
        <p>背景色の処理: <span id="background">No</span></p>
        <p>クリッピングパス設定 (EPS 納品時のみ): <span id="eps">No</span></p>
        <p>解像度変更: <span id="resolution">Yes &#8594; 1980x1280</span></p>
        <p>RGB → CMYK 変換: <span id="rgb_to_cmyk">No</span></p>
        <p>提案金額: <span id="price_order">0</span></p>

        <h3>Download files for project:
            <button class="btn" type="button" name="button" id="project-download-but" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;">
                Download</button>
        </h3>
    </div>
</div>

@section('content')

<br><br>

<br>
<table class="table ordtab" style="margin-left:5%;width:90%;">
    <thead>
        <tr style="background-color:#dadce0;">
            <th>同意</th>
            <th>発注 No.</th>
            <th>発注日時</th>
            <th>要望、注意事項記入欄</th>
            <th>数量</th>
            <th>状態</th>
            <th>金額</th>
            <th>作業前ダウンロード</th>
            <th>無料トライアル</th>
        </tr>
    </thead>
    <tbody>
        @if(count($orders)>0)
        @foreach($orders as $order)
        <tr>
            <td>
                <span style="font-size:25px; color:blue;" class="glyphicon glyphicon glyphicon-ok" onclick="
                  $('#price-set-id').val('{!! $order->id !!}');

                  @if($order->price!=NULL)
                    $('#price-set-value').val('{!! $order->price !!}');
                  @endif

                  $('.price-fade').fadeIn(250);
                "></span>
            </td>
            <td onclick="

              load();

              var xhttp = new XMLHttpRequest();

              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  var data = this.responseText.split('<-#abc pause cba#->');

                  $('#id_order').html({!! $order->id !!});

                  $('#img_nr').html(data[0]);
                  if(data[1].trim() != ''){
                    $('#notes').html(data[1]);
                  }else{
                    $('#notes').html('No notes');
                  }

                  var index = 3;

                  if(data[2] == 1){
                    $('#format').html('Yes &#8594; ' + String(data[3]))
                    index++;
                  }else{
                    $('#format').html('No');
                  }

                  if(data[index]==1){
                    $('#background').html('Yes');
                  }else{
                    $('#background').html('No');
                  }

                  index++;

                  if(data[index]==1){
                    $('#eps').html('Yes');
                  }else{
                    $('#eps').html('No');
                  }

                  index++;

                  if(data[index] == 1){
                    $('#resolution').html('Yes &#8594; ' + String(data[index+1])+'x'+String(data[index+2]))
                    index+=2;
                  }else{
                    $('#resolution').html('No');
                  }

                  index++;

                  if(data[index]==1){
                    $('#rgb_to_cmyk').html('Yes');
                  }else{
                    $('#rgb_to_cmyk').html('No');
                  }

                  index++;

                  if(data[index].trim()!=''){
                    $('#price_order').html(data[index]);
                  }else{
                    $('#price_order').html('Not set');
                  }

                  index++;

                  $('#project-download-but').unbind();
                  $('#project-download-but').click(function(){
                    Download('/files/users/{!! $username !!}/archive_order{!! $order->id !!}.zip');
                  });

                  unload();
                  $('.order-fade').fadeIn(250);

                }
              };
              xhttp.open('GET', '/manager/get-order-data?id={!! $order->id !!}', true);
              xhttp.send();

            ">{!!
                $order->id; !!}</td>
            <td>{!! $order->created_at; !!}</td>
            <td>
                <?php

              if (strlen(strval($order->notes))>7) {
                  echo trim(substr($order->notes, 0, 7))."...";
              } else {
                  echo $order->notes;
              }

            ?>
            </td>
            <td>{!! $order->img_nr; !!}</td>
            <td>
              <?php
if (!$order->confirmed) {
                echo "見積中";
            } else {
                if ($order->finished_date != null) {
                    echo "見積完了";
                } else {
                    echo "処理中";
                }
            }
?>
            </td>
            <td>
                @if($order->price != NULL)

                {!! $order->price; !!}

                @else

                Not set yet

                @endif
            </td>
            <td>
                <span style="font-size:30px;" class="glyphicon glyphicon-cloud-download active" onclick="Download('/files/users/{!! $username !!}/archive_order{!! $order->id !!}.zip');"></span>
            </td>

            <td>

                <?php
              if ($order->free_trial) {
                  echo 'Yes';
              } else {
                  echo 'No';
              }
            ?>

            </td>
        </tr>
        @endforeach
        @else

        <tr>
            <td colspan="9">
                <center>発注ありません</center>
            </td>
        </tr>

        @endif


    </tbody>
</table>
@endsection
