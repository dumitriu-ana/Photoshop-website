<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    @section('dependencies')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/css/admin.css">

    <iframe id="donload_iframe" style="display:none;"></iframe>
    <script>
    function Download(url) {
        document.getElementById('donload_iframe').src = url;
    };
    </script>
    @show

</head>

<body>
  <div class="loading-fade" style="display: none;">
    <div class="loading-div">
      <h3>Loading...</h3>
    </div>
  </div>

  <script type="text/javascript">
    function load(){
      $('.loading-fade').fadeIn(250);
    }

    function unload(){
      $('.loading-fade').fadeOut(250);
    }
  </script>

    <div class="col-xs-10 col-xs-offset-1">
        <div class="row titlu">
            <h2>@yield('title')</h2>
        </div>
        <br><br>
        <div class="col-xs-12 caseta" style="margin-bottom:25px;display: flex; flex-wrap: wrap;">
            <div class="col-xs-12 up" style="padding: 0 !important;">
                <img style="height:95%; margin-left:0;" src="/img/logo_nav_adm.png" alt="">
            </div>

            <div class="col-xs-12" style="background-color:#e4e5eb; height: 50px;">
                <div class="col-xs-9" style="height: 100%; margin:0; margin-left: 25%; padding:0; display:flex; align-items:center; align-content:center;">
                    <h3>@yield('title2')</h3>
                </div>
            </div>
            <div class="col-xs-3 dreapta" style=" padding: 0; min-height: 100% !important;">
                <div style="width: 90%; padding-top:50px;background-color:#e4e5eb;">
                    <center>
                        <button type="button" name="button" onclick="window.location = '/manager/';">オーダー状況</button>
                        <br>
                        <br>
                        <button type="button" name="button" onclick="window.location = '/manager/deliveries';">納品リスト</button>
                        <br>
                        <br>
                        <button type="button" name="button" onclick="window.location = '/manager/client-list';">お客様リスト</button>
                        <br>
                        <br>
                        <button type="button" name="button" onclick="window.location = '/client';">カスタマーサイド</button>
                        <br>
                        <br>
                        <button type="button" name="button" onclick="window.location = '/clear-all';">ログアウト</button>
                        <br>
                        <br>
                    </center>
                </div>
            </div>

            <div class="col-xs-9">
                @yield('content')
            </div>

        </div>
    </div>
</body>

</html>
