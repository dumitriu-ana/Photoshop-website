<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @section('dependencies')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
    <link rel="stylesheet" href="/css/pignose.calendar.css">
    <script src="/js/pignose.calendar.full.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    @show
  </head>
  <body>
<div class="row">
  <nav class="navbar navbar-default" style="margin-bottom: 0 !important;">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#" style="padding: 0;">
          <img src="/img/logo_nav.png" style="height: 100%;" alt="">
        </a>
      </div>
    </div>
  </nav>

  <div class="col-lg-10 col-lg-offset-1 registr">
    <div class="col-lg-9">
      <h3 style="color:white; border-left: solid; padding:4px; margin-left: 10px;">@yield('header')</h3>
      <br>
      <div class="row caseta" style="margin-left: 10px;">
        @yield('content');
      </div>
    </div>
  </div>
</div>


<div class="row down">
  <br><br>
  <center>
    @section('down')
    <a href="/client/commercial-transactions" target="_blank" style="border-right: solid; border-width:1px; padding-right:10px; padding-left:10px;">特定商取引に関する法律に基つく表示</a>
    <a href="/client/terms" target="_blank" style="border-right: solid; border-width:1px; padding-right:10px; padding-left:10px;">利用規約</a>
    <a href="/client/privacy-policy" target="_blank" style="border-right: solid; border-width:1px; padding-right:10px; padding-left:10px;">個人情報保護方針</a>
    <a href="/client/contact" style="padding-left:10px;">お問い合わせ</a>
    @show
    <br><br><br>
  </center>
</div>

  </body>
</html>
