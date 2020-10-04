<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Users;
use App\Admins;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $debug_pages = array(
      'clear-all',
      'cookies',
      'sessions',
    );

    public function putMessage(Request $request, $mess){
      $request->session()->put('message', $mess);
    }

    public function checkEmail($email) {
      $find1 = strpos($email, '@');
      $find2 = strrpos($email, '.');
      return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }

    public function setCookie($name, $value, $days=7){
      setcookie($name, $value, time()+$days*24*365);
    }

    public function getCookie($name, $default = false){
      if(isset($_COOKIE[$name])){
        return $_COOKIE[$name];
      }else{
        return $default;
      }
    }

    public function get_basic_data(Request $request){
      $data = array();

      $user = $this->getCookie('loggedUser');
      if($user || $request->session()->has('loggedUser')){
        if($user){
          $username = $user;
        }else{
          $username = $request->session()->get('loggedUser');
        }

        $data['username'] = $username;

        $user = Users::where('username', $username)->get()[0];
        $free_trials = $user->free_trials;

        $admin = 0;
        if(count(Admins::where('user_id', $user->id)->get())>0){
          $admin = 1;
        }

        $data['free_trials'] = $free_trials;
        $data['admin'] = $admin;

      }



      return $data;
    }

    public function get_basic_admin_data(Request $request){
      $data = $this->get_basic_data($request);

      return $data;
    }

}
