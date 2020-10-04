@extends('layouts.clientlayout')

@section('title', 'Contact us')
@section('header', 'Contact us')

@section('content')

<div class="row caseta" style="margin-left: 10px; padding: 10px;">
  <div class="col-xs-10 col-xs-offset-1">


  <br>
  <a href="#"><span class="glyphicon glyphicon-play"></span>
    Frequently asked questions</a>

  <p style="margin-top: 25px;">Frequently asked questions from customers. Please check this out.</p>

  <div class="col-xs-4">
    <p>Client</p>
  </div>
  <div class="col-xs-8">
    <p>{!! $username !!}</p>
  </div>
  <div class="col-xs-4">
    <p>Email address</p>
  </div>
  <div class="col-xs-8">
    <p>{!! $email !!}</p>
  </div>
  <p>Write 400 letters maximum.</p>
  <form action="/client/contact" method="post">
    @csrf
    <input style="display: none;" type="text" name="username" value="{!! $username !!}">
    <textarea style="
    resize: none;
    border-radius:5px;
    min-height:200px;
    margin-bottom:30px;
    min-width:100% !important;
    " maxlength="400"
    name="message" class="col-xs-12"></textarea>

    <center>
      <input style="border: none; padding-top: 15px; padding-bottom: 15px;"
      type="submit" name="submit" value="Send">
    </center>
  </form>
  <br><br>
</div>
  </div>

@endsection
