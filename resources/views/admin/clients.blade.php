@extends('admin/layouts/base_layout')

@section('title', 'お客様リスト')
@section('title2', 'お客様リスト')

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


@section('content')

<br><br>

<br>
<table class="table ordtab" style="margin-left:5%;width:90%;">
    <thead>
        <tr style="background-color:#dadce0;">
            <th>発注 No.</th>
            <th>ユーザー名</th>
            <th>メール</th>
            <th>登録日時</th>
            <th>注文点数</th>
        </tr>
    </thead>
    <tbody>
        @if(count($users)>0)
        @foreach($users as $user)

        <tr>
          <td>{!! $user->id !!}</td>
          <td>{!! $user->username !!}</td>
          <td>{!! $user->email !!}</td>
          <td>{!! $user->created_at !!}</td>
          <td>{!! $orders_nr[$username] !!}</td>
        </tr>

        @endforeach
        @else

        <tr>
            <td colspan="9">
                <center>お客様ありません</center>
            </td>
        </tr>

        @endif


    </tbody>
</table>
@endsection
