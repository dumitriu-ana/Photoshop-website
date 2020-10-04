<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', 'CommonController@login');
Route::post('/login', 'CommonController@login');

Route::get('/register', 'CommonController@register');
Route::post('/register', 'CommonController@register');

Route::get('/setup-account/{id}', 'CommonController@setup_account');
Route::post('/setup-account/{id}', 'CommonController@setup_account');

Route::get('/forgot-password', 'CommonController@forgot_password');
Route::post('/forgot-password', 'CommonController@forgot_password');

Route::get('/terms', 'CommonController@terms');

// CLIENT
Route::resource('/client', 'ClientController');
Route::post('/client/profile', 'ClientController@profile');
Route::post('/client/modify-mail', 'ClientController@modify_mail');
Route::post('/client/new-order-estimation', 'ClientController@new_order_estimation');
Route::post('/client/auto-estimation', 'ClientController@auto_estimation');
Route::post('/client/free-trial', 'ClientController@free_trial');

Route::post('/client/contact', 'ClientController@contact');

// MANAGER
Route::resource('/manager', 'ManagerController');
Route::post('/manager/set-order-price', 'ManagerController@set_order_price');
Route::post('/manager/send-message', 'ManagerController@send_message');
Route::post('/manager/upload-project', 'ManagerController@upload_project');

// DEBUG

Route::get('/cookies', function (Request $request) {
    print_r($_COOKIE);
});

Route::get('/sessions', function (Request $request) {
    print_r($request->session()->all());
});

Route::get('/clear-all', function (Request $request) {
    $request->session()->flush();
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
    return redirect('/');
});
