@extends('admin/layouts/base_layout')

@section('title', '納品リスト')
@section('title2', '納品リスト')

@section('dependencies')
@parent

<style media="screen">

  tr:hover{
    background-color: #c9c9c9;
    cursor: pointer !important;
  }

  td .glyphicon:hover{
    cursor: pointer !important;
  }

</style>

@endsection

<div class="order-fade" style="display: none;">
    <div class="order-content">
        <div class="close-but" onclick="$('.order-fade').fadeOut();">
            X
        </div>

        <h1>発注 No. <span id="id_order">0</span></h1>
        <br>
        <p>画像点数: <span id="img_nr">0</span></p>
        <p>要望、注意事項記入欄: <span id="notes">jkl</span></p>
        <p>ファイル形式変換: <span id="format">Yes &#8594; jpeg</span></p>
        <p>背景色の処理: <span id="background">No</span></p>
        <p>クリッピングパス設定 (EPS 納品時のみ): <span id="eps">No</span></p>
        <p>解像度変更: <span id="resolution">Yes &#8594; 1980x1280</span></p>
        <p>RGB → CMYK 変換: <span id="rgb_to_cmyk">No</span></p>
        <p>最終価格: <span id="price_order">0</span></p>

        <h3>作業前ダウンロード:
            <button class="btn" type="button" name="button" id="project-download-but" style="width:150px; background-color:#003b99; color:white; border-radius:15px; margin-left:30px;">
                ダウンロード</button>
        </h3>
    </div>
</div>


@section('content')
<iframe src="" id="receipt-canvas" style="display: none;"></iframe>
<br><br>

<br>
<table class="table ordtab" style="margin-left:5%;max-width:90%;">
    <thead>
        <tr style="background-color:#dadce0;">
            <th>プロジェクト発信</th>
            <th>発注 No.</th>
            <th>日時</th>
            <th>要望、注意事項記入欄</th>
            <th>画像点数</th>
            <th>状態</th>
            <th>作業前ダウンロード</th>
            <th>領収書ダウンロード</th>
        </tr>
    </thead>
    <tbody>

      @if(count($orders)>0)
        @foreach($orders as $order)
        <tr>


            <td>
              <input type="file" name="upload-project" style="display: none;"
                  onchange="
                    var data = this.files[0];

                    if(data.name.split('.')[data.name.split('.').length-1].trim()=='zip'){
                      load();
                      var formData = new FormData();
                      formData.append('archive', data);

                      $.ajax({
                        url: '/manager/upload-project?id={!! $order->id !!}',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(data){
                          window.location = '/manager/deliveries';
                        }
                      });

                    }else{

                      alert('Please upload a zip file.');
                    }
                  "
                >
              <span style="font-size:25px; color:red; transform: scale(-1, 1);" class="glyphicon glyphicon-share-alt"
                onclick="
                  $(this).parent().find('input').trigger('click');
                "
              ></span>
            </td>
            <td
            onclick="

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

           "
            >{!! $order->id !!}</td>
            <td>{!! $order->created_at !!}</td>
            <td>
                <?php
              if (strlen(strval($order->notes))>7) {
                  echo trim(substr($order->notes, 0, 7))."...";
              } else {
                  echo $order->notes;
              }
            ?>
            </td>
            <td>{!! $order->img_nr !!}</td>
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
            <td> <span style="font-size:30px;" class="glyphicon glyphicon-cloud-download"
              onclick="

                Download('/files/users/{!! $order->customer_username; !!}/archive_order{!! $order->id !!}.zip');

              "></span> </td>
            <td> <span style="font-size:30px;" class="glyphicon glyphicon-cloud-download active"
                onclick="
                  $('#receipt-canvas').attr('src', '/manager/get-order-receipt?id={!! $order->id !!}')
                "
              ></span> </td>
        </tr>
        @endforeach
      @else

        <tr>
          <td colspan="8"><center>発注ありません</center></td>
        </tr>

      @endif

    </tbody>
</table>
@endsection
