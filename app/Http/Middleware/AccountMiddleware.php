<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Users;
use App\Admins;
use App\Orders;
use File;
use Carbon\Carbon;

class AccountMiddleware extends \App\Http\Controllers\Controller
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

      $segment = $request->segment(1);
      $user = $this->getCookie('loggedUser');

      $username = NULL;

      if(!in_array($segment, $this->debug_pages)){
        if($segment!='client' &&
        $segment!='manager'){
          if($user || $request->session()->has('loggedUser')){
            if($user){
              $username = $user;
            }else{
              $username = $request->session()->get('loggedUser');
            }

            $userRes = Users::where('username', $username)->get();

            if(count($userRes)>0){
              if(!$request->session()->has('loggedUser')){
                $request->session()->put('loggedUser', $user);
              }
              $this->putMessage($request, 'Logged in');
              return redirect('/client');
            }else{
              return redirect('/clear-all');
            }
          }
        }else{
          if(!$user && !$request->session()->has('loggedUser')){
            $this->putMessage($request, 'Please login first');
            return redirect('/');
          }
        }
      }

      if($username == NULL){
        if($user || $request->session()->has('loggedUser')){
          if($user){
            $username = $user;
          }else{
            $username = $request->session()->get('loggedUser');
          }
        }
      }

      if($username != NULL){
        $path = public_path().'/files/users/'.$username;
        if(!File::exists($path)) {
          File::makeDirectory($path, $mode=0777, true, true);
        }

        $orders = Orders::where('customer_username', $username)->whereNotNull('finished_date')->get();
        $now = Carbon::now();

        foreach($orders as $order){
          $date = Carbon::parse($order->finished_date)->addDays(5);

          if($date->isPast()){
            $path =public_path().'/files/users/'.$username.'/archive_order'.$order->id.'.zip';
            if(File::exists($path)){
              File::delete($path);
            }
          }
        }

      }

      $adminResults = Admins::get();

      if(count($adminResults)==0){
        $resultUsernameAdmin = Users::where('username', 'admin')->get();
        $resultAdmin = null;
        if(count($resultUsernameAdmin)==0){
          $resultAdmin = new Users;
          $resultAdmin->username = 'admin';
          $resultAdmin->email = 'example@gmail.com';
          $resultAdmin->password = 'admin987';
          $resultAdmin->save();
        }else{
          $resultAdmin = $resultUsernameAdmin[0];
        }

        $admin = new Admins;
        $admin->user_id = $resultAdmin->id;
        $admin->save();

        $path = public_path().'/files/users/'.strval($resultAdmin->username);
        if(File::exists($path)) {
          File::deleteDirectory($path);
        }
        File::makeDirectory($path, $mode=0777, true, true);
      }

      return $next($request);
    }
}
