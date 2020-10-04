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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/af.js" integrity="sha256-I5ZXO8KcMnqNkrXU7baGig70nATYjNDnxxA2d40PcR8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/style.css">
  @show
</head>

<body>
  <div class="row">

    @section('navbar')
    <nav class="navbar navbar-default" style="margin-bottom: 0 !important;">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/client" style="padding: 0;">
          <img src="/img/logo_nav.png" style="height: 100%;" alt="">
        </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li style="border-left:solid; border-width:1px; padding-left:8px;"><a href="/clear-all"><span class="glyphicon glyphicon-user"></span> ログアウト</a></li>
          <li style="border-left:solid; border-right: solid; border-width:1px; padding-left:8px; margin-right:70px;"><a href="/client/contact"><span class="glyphicon glyphicon-log-in"></span> お問い合わせ</a></li>
        </ul>
      </div>
    </nav>
    @show


    <div class="col-lg-10 col-lg-offset-1">
      @section('navbar-left')
      <div class="col-xs-3 caseta" style="min-height: 85vh;">
        <br>
        <button style="background-color:#003b99;" type="button"
        onclick="window.location = '/client';"
        class="btn btn-primary btn-sm btn-block">My page</button>
        <center>
          <br>
          <img style="width:50px;" src="/img/user.png" alt="">
          <br>
          <p>{!! $username !!}</p>
        </center>

        <ul>
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/client">My page top</a> </li>
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/client/service-guide">サービス流れ</a> </li>
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/client/new-order-estimation">新規オーダー見積もり依頼</a> </li>
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/client/order-list">オーダーリスト</a> </li>
          @if($free_trials>0)
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/client/free-trial">無料トライアル</a> </li>
          @endif
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/client/profile">アカウント情報</a> </li>
          @if($admin)
          <li> <span class="glyphicon glyphicon-play"></span> <a href="/manager">管理</a> </li>
          @endif
        </ul>
        <center><img style="width:150px;" src="/img/yellow.png" alt=""></center>
        <br>
      </div>
      @show

      <div class="row col-xs-9 registr">
        <div class="col-xs-12">
          <h3 style="color:white; border-left: solid; padding:4px; margin-left: 10px;">@yield('header')</h3>
          <br>
          @yield('content')
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
