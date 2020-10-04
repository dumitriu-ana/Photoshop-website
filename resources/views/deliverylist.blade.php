@extends('layouts.clientlayout')
@section('title', 'Delivery list')
@section('header', 'Delivery list')

@section('dependencies')
@parent


<style media="screen">
  .glyphicon-cloud-download.active:hover{
    cursor: pointer !important;
  }
</style>
@endsection

@section('content')
<iframe id="donload_iframe" style="display:none;"></iframe>
<script>
function Download(url) {
    document.getElementById('donload_iframe').src = url;
};
</script>
<div class="row caseta" style="margin-left: 10px;">
<div class="">
  <br><br>
  <div class="col-xs-12">
    <div class="col-xs-6">
    <p style="border-left:solid; margin: 5px; padding-left:8px;border-color:black; border-width:2px;"><b>lorem ipsum</b></p>
    </div>
  </div>

<table class="table ordtab" style="margin-left:5%;width:90%;">
<thead>
<tr style="background-color:#dadce0;">
<th>Id</th>
<th>Order date</th>
<th>Order name</th>
<th>Delivery day</th>
<th>Download</th>
</tr>
</thead>
<tbody>

@foreach($delivers as $deliver)

<tr>
<td>{{ $deliver->id }}</td>
<td>{{ strval($deliver->created_at) }}</td>
<td>
<?php
  if(strlen(strval($deliver->notes))>7){
    echo trim(substr($deliver->notes, 0, 7))."...";
  }else{
    echo $deliver->notes;
  }
?>
</td>
<td>{{ $deliver->finished_date }}</td>

<?php

  $expireDate = \Carbon\Carbon::parse($deliver->finished_date)->addDays(5);
  $ok = 0;
  if($expireDate->gt(\Carbon\Carbon::now())){
    $ok = 1;
  }

?>
<td> <span style="font-size:30px;
  " class="glyphicon glyphicon-cloud-download

<?php

if($ok){
  echo 'active';
}

?>

  "
  @if($ok)

    onclick="
      var path = '/files/users/{!! $username !!}/archive_delivery{!! $deliver->id !!}.zip';

      Download(path);
    "

  @endif></span> </td>
</tr>

@endforeach

</tbody>
</table>
<br>

  </div>
</div>

@endsection
