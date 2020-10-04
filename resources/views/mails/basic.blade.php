<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{!! strval(env('APP_NAME', 'Photoshop website')) !!}</title>
  </head>
  <body>
    <h3>Hello, {!! strval($username) !!}!</h3>
    <p>{!! strval($content) !!}

      @isset($link)

      <a href="{!! strval($link) !!}">{!! $link !!}</a>

      @endisset

    </p>
  </body>
</html>
