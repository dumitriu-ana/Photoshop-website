<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use File;
use Mail;

class CommonController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('login');
        } elseif ($request->isMethod('post')) {
            $username = strval($request->input('username'));
            $password = strval($request->input('password'));

            $userRes = Users::where('password', $password)
                        ->where(function ($query) use ($username) {
                            $query->where('email', '=', $username)
                          ->orWhere('username', '=', $username);
                        })->get();

            if (count($userRes)>0) {
                $user = $userRes[0];

                $request->session()->put('loggedUser', $user->username);

                if ($request->has('save-pass')) {
                    $this->setCookie('loggedUser', $user->username, 7);
                }

                $this->putMessage($request, 'Logged in.');
                return redirect('/client');
            } else {
                $this->putMessage($request, 'Username, email or password incorrect.');
                return redirect('/login');
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $username = strval($request->input('username'));
            $mail = strval($request->input('mail'));

            if (strpos($username, '/') !== false || strpos($username, '\\') !== false) {
                $this->putMessage($request, 'Username may not contain "/" or "\".');
                return redirect('/register');
            }

            if (!$this->checkEmail($mail)) {
                $this->putMessage($request, 'Please insert a valid email address.');
                return redirect('/register');
            }

            $usersUsernameResult = Users::where('username', $username)->get();
            $usersMailResult = Users::where('email', $mail)->get();

            if (count($usersUsernameResult) != 0 ||
          count($usersMailResult) != 0) {
                $message = '';
                if (count($usersUsernameResult) != 0) {
                    $message = 'An user with the same username already exists.';
                } else {
                    $message = 'An user with the same email already exists.';
                }

                $this->putMessage($request, $message);
                return redirect('/register');
            }

            $new_user = new Users;
            $new_user->username=$username;
            $new_user->email=$mail;

            $new_user->save();

            $path = public_path().'/files/users/'.strval($new_user->username);
            if (File::exists($path)) {
                File::deleteDirectory($path);
            }
            File::makeDirectory($path, $mode=0777, true, true);


            $link = strval($request->getHost().'/setup-account/'.strval($new_user->id));

            Mail::send(
                ['html' => 'mails.accountverify'],
                ['link' => $link, 'name' => $username],
                function ($message) use ($mail) {
                    $message->from(
                        'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                        env('APP_NAME', 'Photoshop website')
            );

                    $message->to($mail)->subject('Verify your email address.');
                }
        );


            $this->putMessage($request, 'Account created successfully.');
            return redirect('/register');
        }

        return view('register');
    }

    public function setup_account(Request $request, $id)
    {
        $ok = 1;

        if ($request->isMethod('get')) {
            if ($id != null && $id != 0) {
                $userRes = Users::where('id', $id)->get();

                if (count($userRes)>0) {
                    $user = $userRes[0];

                    if ($user->password==null) {
                        return view('register2', [
                'mail'=>strval($user->email),
                'username'=>strval($user->username)
              ]);
                    } else {
                        $this->putMessage($request, 'Account already setup.');
                        return redirect('/');
                    }
                } else {
                    $ok = 0;
                }
            } else {
                $ok = 0;
            }
        } else {
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            $userRes = Users::where('username', $username)->where('email', $mail)->get();

            if (count($userRes)>0 && $password!=null && $password!='') {
                $user = $userRes[0];
                $user->password = $password;
                $user->save();

                $this->putMessage($request, 'Account setup successfully');
                return redirect('/');
            } else {
                $ok = 0;
            }
        }

        if (!$ok) {
            $this->putMessage($request, 'Bad request');
            return redirect('/');
        }
    }

    public function forgot_password(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('forgotpassword');
        } elseif ($request->isMethod('post')) {
            $ok = 1;
            $mail = strval($request->input('mail'));

            $userRes = Users::where('email', $mail)->get();

            if (count($userRes)>0) {
                $user = $userRes[0];
                $text = 'Thank you for using '.strval(env('APP_NAME', 'Photoshop website')).'! ';
                $text.='Your password is: '.$user->password;

                Mail::raw($text, function ($message) use ($user) {
                    $message->from(
                        'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                        env('APP_NAME', 'Photoshop website')
            );

                    $message->to($user->email)->subject('Recover your password.');
                });
            } else {
                $ok = 0;
            }

            if (!$ok) {
                $this->putMessage($request, 'There is no such email in database.');
                return redirect('/forgot-password');
            }

            $this
          ->putMessage($request, 'An email has been sent to you containing your account password.');

            return redirect('/login');
        }
    }

    public function terms(Request $request){
      $base_data = $this->get_basic_data($request);

      return view('terms', $base_data);
    }
}
