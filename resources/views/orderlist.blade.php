<div class="mess-box" id="error-alert" style="display: none;">
    <div class="mess">
        <p id="error-message"></p>
        <center>
            <button id='error-but' style="border:none; background-color:white;" type="button" name="button" onclick="$('#error-alert').fadeOut(250);">OK</button>
        </center>
    </div>
</div>

@extends('layouts.clientlayout')
@section('title', '見積り依頼')
@section('header','見積り依頼')
@section('content')
<div class="row caseta" style="margin-left: 10px;">
    <div class="">
        <br><br>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <button style="color:white; margin:5px; background-color:black; border:none;" type="button" name="button" onclick="

      $('#error-but').hide();
      $('#error-message').html('Canceling orders.');
      $('#error-alert').fadeIn(250);
      //var orders = [];

      var processes = 0;
      var error = false;

      var body = $('tbody');
      var children = body.children();

      $.each( children, function( key, value ) {
        value  = $(value);
        var checked = value.find('input').prop('checked');

        if(checked){
          //orders.push($(value.children()[1]).html());

          if($(value.children()[6]).html().trim()=='estimating'){
            processes++;

            var val = value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
               val.remove();
               processes--;

               if(this.responseText=='error'){
                 error = true;
               }

               if(processes==0){
                 $('#error-but').show();
                 if(error){
                   $('#error-message').html('An error occured.');
                   $('#error-alert').fadeIn(250);
                 }else{
                   $('#error-message').html('Orders cancelled successfully.');
                   $('#error-alert').fadeIn(250);
                 }
               }
              }
            };

            xhttp.open('GET',
            '/client/cancel-order?id='+String($(value.children()[1]).html()),
            true);

            xhttp.send();
          }else{
            $('#error-message').html('Orders must be in \'estimating\' status.');
            $('#error-alert').fadeIn(250);
          }
        }
      });

      console.log(orders);
    ">注文キャンセルボタン</button>
            </div>

        </div>
        <div class="col-xs-12">
            <br>
            <div class="col-xs-6">
                <p style="border-left:solid; margin: 5px; padding-left:8px;border-color:black; border-width:2px;"><b>納品リスト</b></p>
            </div>
        </div>

        <table class="table ordtab" style="margin-left:5%;width:90%;">
            <thead>

                <tr style="background-color:#dadce0;">
                    <th>選択</th>
                    <th>発注 No.</th>
                    <th>発注日時</th>
                    <th>要望、注意事項記入欄</th>
                    <th>数量</th>
                    <th>納品希望日</th>
                    <th>状態</th>
                </tr>
            </thead>

            <tbody>

                @if(count($orders)>0)

                @foreach ($orders as $order)

                <tr>
                    <td>
                        <center><input type="checkbox" name="" value=""> </center>
                    </td>
                    <td>{{ strval($order->id) }}</td>
                    <td>{{ strval($order->created_at) }}</td>
                    <td>
                        <?php

  if(strlen(strval($order->notes))>7){
    echo trim(substr($order->notes, 0, 7))."...";
  }else{
    echo $order->notes;
  }

?>
                    </td>
                    <td>{{ strval($order->img_nr) }}</td>
                    <td>
                        <?php
  if($order->finished_date!=NULL){
    echo strval($order->finished_date);
  }else{
    echo '-';
  }
?>
                    </td>
                    <td>
                        <?php
  if(!$order->confirmed){
    echo "見積中";
  }else{
    if($order->finished_date != NULL){
      echo "見積完了";
    }else{
      echo "処理中";
    }
  }
?>
                    </td>
                </tr>

                @endforeach

                @else

                <tr>
                    <td colspan="7">No orders yet</td>
                </tr>

                @endif
            </tbody>
        </table>
        <br>

    </div>
</div>
@endsection
