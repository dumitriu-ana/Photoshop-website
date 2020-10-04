<?php

namespace App\Http\Middleware;

use Closure;
use File;

class CommonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      $ratetablePath = public_path().'/files/configs/ratetable.conf';

      if(!File::exists($ratetablePath)){
        $normal = [];
        array_push($normal, 240);
        $type = [];
        $type['a']=500;
        $type['b']=1000;
        $type['c']=1500;

        $content = [];
        $content['normal']=$normal;
        $content['types']=$type;

        $contentFile = json_encode($content);

        File::put($ratetablePath, $contentFile);
      }


      // message
      if($request->path()!='/'){
        if($request->session()->has('message')){
          $message = strval($request->session()->pull('message'));

          echo '<div class="logout" id="message-alert">
            <div class="mess">
              <p>'.$message.'</p>
              <center>
                <button style="border:none; background-color:white;" type="button"
                 name="button" onclick="$(\'#message-alert\').fadeOut(250);">OK</button>
              </center>
            </div>
          </div>';
        }
      }

      return $next($request);
    }
}
