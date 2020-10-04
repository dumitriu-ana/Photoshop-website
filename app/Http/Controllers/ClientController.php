<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Admins;
use App\Orders;
use App\Messages;
use Mail;
use File;
use PDF;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        return view('index', $base_data);
    }

    public function store(Request $requset)
    {
    }

    public function show(Request $request, $aux)
    {
        $base_data = $this->get_basic_data($request);

        switch ($aux) {
      case 'contact':
        return $this->contact($request);
        break;
      case 'profile':
        return $this->profile($request);
        break;
      case 'modify-mail':
        return $this->modify_mail($request);
        break;
      case 'service-guide':
        return $this->service_guide($request);
        break;

      case 'order-list':
        return $this->order_list($request);
        break;

      case 'new-order-estimation':
        return $this->new_order_estimation($request);
        break;

      case 'auto-estimation':
        return $this->auto_estimation($request);
        break;

      case 'free-trial':
        return $this->free_trial($request);
        break;

      case 'approve-order':
        return $this->approve_order($request);
        break;

      case 'cancel-order':
        return $this->cancel_order($request);
        break;

      case 'contact':
        return $this->contact($request);
        break;

      case 'confirm-order':
        return $this->confirm_order($request);
        break;

      case 'finish-order':
        return $this->finish_order($request);
        break;

      case 'get-finished-order':
        return $this->get_finished_order($request);
        break;

      case 'get-order-receipt':
        return $this->get_order_receipt($request);
        break;

      case 'commercial-transactions':
        return $this->commercial_transactions($request);
        break;

      case 'privacy-policy':
        return $this->policy($request);
        break;

      case 'terms':
        return $this->terms($request);
        break;

      default:
        return view($aux, $base_data);
        break;
    }
    }

    public function commercial_transactions(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        return view('displaybased', $base_data);
    }

    public function terms(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        return view('terms', $base_data);
    }

    public function policy(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        return view('privacypolicy', $base_data);
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $username = strval($request->input('username'));
            $message = strval($request->input('message'));

            $mess = new Messages;
            $mess->username=$username;
            $mess->message = $message;
            $mess->save();

            $userContacter = Users::where('username', $username)->get()[0];

            $admins = Admins::get();

            foreach ($admins as $admin) {
                $userAdminRes = Users::where('id', $admin->user_id)->get();

                if (count($userAdminRes)>0) {
                    $userAdmin = $userAdminRes[0];

                    $mail = $userAdmin->email;
                    $username = $userAdmin->username;

                    Mail::send(
                        ['html' => 'mails.basic'],
                        ['content' => 'You have a new message from "'.$userContacter->email.'": '.$mess->message,
                'username' => $username],
                        function ($m) use ($mail, $userContacter) {
                            $m->from(
                        'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                        env('APP_NAME', 'Photoshop website')
                    );

                            $m->to($mail)->subject('New message from "'.$userContacter->email.'".');
                        }
            );
                }
            }

            $this->putMessage($request, 'Message sent successfully.');

            return redirect('/client');
        } else {
            $base_data = $this->get_basic_data($request);

            $user = Users::where('username', $base_data['username'])->get()[0];

            $base_data['email'] = $user->email;

            return view('contactus', $base_data);
        }
    }

    public function free_trial(Request $request)
    {
        if ($request->isMethod('post')) {
            $username = strval($request->input('username'));
            $img_nr = intval($request->input('nr-img'));

            $notes = strval($request->input('notes'));

            $format = $request->has('format');
            $ext = null;

            if ($format) {
                $ext = $request->input('extension');
            }

            $background = $request->has('backgr');

            $eps = $request->has('eps');

            $resolution_ch = $request->has('resolution');

            if ($resolution_ch) {
                $res_x = intval($request->input('resX'));
                $res_y = intval($request->input('resY'));
            }

            $rgb_to_cmyk = $request->has('color-format');

            // NEW ORDER

            $new_order = new Orders;
            $new_order->customer_username = $username;
            $new_order->img_nr = $img_nr;

            $new_order->notes = $notes;
            $new_order->format = $ext;
            $new_order->background = $background;
            $new_order->eps = $eps;
            $new_order->resolution_change = $resolution_ch;

            if ($resolution_ch) {
                $new_order->res_x = $res_x;
                $new_order->res_y = $res_y;
            }

            $new_order->rgb_to_cmyk = $rgb_to_cmyk;
            $new_order->confirmed = false;
            $new_order->free_trial = 1;
            $new_order->save();

            //  ZIP FILE

            $zip = $request->file('upload-zip');
            $path = "files/users/".$username;
            $file_name = "archive_order".strval($new_order->id).".zip";
            $files_path = $path."/".$file_name;

            $zip->move($path, $file_name);

            $new_order->files_path = public_path().$files_path;
            $new_order->save();

            $mail = Users::where('username', $username)->get()[0]->email;

            $user = Users::where('username', $username)->get()[0];
            $user->free_trials = $user->free_trials-1;

            $user->save();

            Mail::send(
                ['html' => 'mails.basic'],
                ['content' => 'Your order is waiting to be estimated by one of our managers.
            Thank you for using '.strval(env('APP_NAME', 'Photoshop website')),
            'username' => $username],
                function ($m) use ($mail) {
                    $m->from(
                    'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                    env('APP_NAME', 'Photoshop website')
                );

                    $m->to($mail)->subject('Your order has been placed.');
                }
        );

            $admins = Admins::get();

            for ($i=0; $i < count($admins); $i++) {
                $userAdmin = Users::where('id', $admins[$i]->user_id)->get();

                if (count($userAdmin)==1) {
                    $mail = $userAdmin[0]->email;

                    Mail::send(
                        ['html' => 'mails.basic'],
                        ['content' => 'You have a new order.
                Please visit ',
                'link'=>strval(request()->getHttpHost()),
                'username' => $userAdmin[0]->username],
                        function ($m) use ($mail) {
                            $m->from(
                        'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                        env('APP_NAME', 'Photoshop website')
                    );

                            $m->to($mail)->subject('Your order has been placed.');
                        }
            );
                }
            }

            $this->putMessage($request, 'Order placed successfully.');

            return redirect('/client');
        } else {
            $base_data = $this->get_basic_data($request);

            return view('freetrial', $base_data);
        }
    }

    public function profile(Request $request)
    {
        $base_data = $this->get_basic_data($request);
        $username = $base_data['username'];

        $userRes = Users::where('username', $username)->get()[0];


        if ($request->isMethod('get')) {
            $base_data['mail'] = $userRes->email;
            $base_data['password'] = $userRes->password;

            return view('accountinformation', $base_data);
        } elseif ($request->isMethod('post')) {
            $actual_password = strval($request->input('actual_password'));
            $new_password = strval($request->input('new_password'));
            $new_verif_password = strval($request->input('conf_new_password'));

            if ($userRes->password!=$actual_password) {
                $this->putMessage($request, 'This is not your actual password.');
                return redirect('/client/profile');
            }

            if ($new_password!=$new_verif_password) {
                $this->putMessage($request, 'New password and password confirmation does not match.');
                return redirect('/client/profile');
            }

            $userRes->password = $new_password;
            $userRes->save();

            $this->putMessage($request, 'Password changed successfully.');
            return redirect('/client/profile');
        }
    }

    public function modify_mail(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        $username = $base_data['username'];

        $userRes = Users::where('username', $username)->get()[0];

        if ($request->isMethod('get')) {
            $base_data['mail'] = $userRes->email;
            $base_data['password'] = $userRes->password;

            return view('accountinformation2', $base_data);
        } elseif ($request->isMethod('post')) {
            $new_mail = strval($request->input('mail'));
            $new_mail_verif = strval($request->input('mail_verif'));

            if ($new_mail!=$new_mail_verif) {
                $this->putMessage($request, 'New mail and mail confirmation does not match.');
                return redirect('/client/modify-mail');
            }

            $userRes->email = $new_mail;
            $userRes->save();

            $this->putMessage($request, 'Mail updated successfully.');
            return redirect('/client/modify-mail');
        }
    }

    public function service_guide(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        return view('serviceguide', $base_data);
    }

    public function order_list(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        $username = strval($base_data['username']);

        $orders = Orders::where('customer_username', $username)->get();

        $base_data['orders'] = $orders;

        return view('orderlist', $base_data);
    }

    public function new_order_estimation(Request $request)
    {
        if ($request->isMethod('post')) {
            $username = strval($request->input('username'));
            $img_nr = intval($request->input('nr-img'));

            $notes = strval($request->input('notes'));

            $format = $request->has('format');
            $ext = null;

            if ($format) {
                $ext = $request->input('extension');
            }

            $background = $request->has('backgr');

            $eps = $request->has('eps');

            $resolution_ch = $request->has('resolution');

            if ($resolution_ch) {
                $res_x = intval($request->input('resX'));
                $res_y = intval($request->input('resY'));
            }

            $rgb_to_cmyk = $request->has('color-format');

            // NEW ORDER

            $new_order = new Orders;
            $new_order->customer_username = $username;
            $new_order->img_nr = $img_nr;

            $new_order->notes = $notes;
            $new_order->format = $ext;
            $new_order->background = $background;
            $new_order->eps = $eps;
            $new_order->resolution_change = $resolution_ch;

            if ($resolution_ch) {
                $new_order->res_x = $res_x;
                $new_order->res_y = $res_y;
            }

            $new_order->rgb_to_cmyk = $rgb_to_cmyk;
            $new_order->confirmed = false;

            $new_order->save();

            //  ZIP FILE

            $zip = $request->file('upload-zip');
            $path = "files/users/".$username;
            $file_name = "archive_order".strval($new_order->id).".zip";
            $files_path = $path."/".$file_name;

            $zip->move($path, $file_name);

            $new_order->files_path = public_path().$files_path;
            $new_order->save();

            $mail = Users::where('username', $username)->get()[0]->email;

            Mail::send(
                ['html' => 'mails.basic'],
                ['content' => 'Your order is waiting to be estimated by one of our managers.
                Thank you for using '.strval(env('APP_NAME', 'Photoshop website')),
                'username' => $username],
                function ($m) use ($mail) {
                    $m->from(
                        'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                        env('APP_NAME', 'Photoshop website')
                    );

                    $m->to($mail)->subject('Your order has been placed.');
                }
            );

            $admins = Admins::get();

            for ($i=0; $i < count($admins); $i++) {
                $userAdmin = Users::where('id', $admins[$i]->user_id)->get();

                if (count($userAdmin)==1) {
                    $mail = $userAdmin[0]->email;

                    Mail::send(
                        ['html' => 'mails.basic'],
                        ['content' => 'You have a new order.
                    Please visit ',
                    'link'=>strval(request()->getHttpHost()),
                    'username' => $userAdmin[0]->username],
                        function ($m) use ($mail) {
                            $m->from(
                            'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                            env('APP_NAME', 'Photoshop website')
                        );

                            $m->to($mail)->subject('Your order has been placed.');
                        }
                );
                }
            }

            $this->putMessage($request, 'Order placed successfully.');

            return redirect('/client');
        } else {
            $base_data = $this->get_basic_data($request);
            return view('neworderestimation', $base_data);
        }
    }


    public function auto_estimation(Request $request)
    {
        if ($request->isMethod('post')) {
            $price = intval($request->input('price'));
            echo $price;

            $username = strval($request->input('username'));
            $img_nr = intval($request->input('nr-img'));

            $notes = strval($request->input('notes'));

            $format = $request->has('format');
            $ext = null;

            if ($format) {
                $ext = $request->input('extension');
            }

            $background = $request->has('backgr');

            $eps = $request->has('eps');

            $resolution_ch = $request->has('resolution');

            if ($resolution_ch) {
                $res_x = intval($request->input('resX'));
                $res_y = intval($request->input('resY'));
            }

            $rgb_to_cmyk = $request->has('color-format');

            // NEW ORDER

            $new_order = new Orders;
            $new_order->customer_username = $username;
            $new_order->img_nr = $img_nr;

            $new_order->notes = $notes;
            $new_order->format = $ext;
            $new_order->background = $background;
            $new_order->eps = $eps;
            $new_order->resolution_change = $resolution_ch;

            if ($resolution_ch) {
                $new_order->res_x = $res_x;
                $new_order->res_y = $res_y;
            }

            $new_order->rgb_to_cmyk = $rgb_to_cmyk;
            $new_order->confirmed = false;
            $new_order->price = $price;

            $new_order->save();

            //  ZIP FILE

            $zip = $request->file('upload-zip');
            $path = "files/users/".$username;
            $file_name = "archive_order".strval($new_order->id).".zip";
            $files_path = $path."/".$file_name;

            $zip->move($path, $file_name);

            $new_order->files_path = public_path().$files_path;
            $new_order->save();

            $mail = Users::where('username', $username)->get()[0]->email;

            Mail::send(
                ['html' => 'mails.basic'],
                ['content' => 'Your order is waiting to be estimated by one of our managers.
            Thank you for using '.strval(env('APP_NAME', 'Photoshop website')),
            'username' => $username],
                function ($m) use ($mail) {
                    $m->from(
                    'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                    env('APP_NAME', 'Photoshop website')
                );

                    $m->to($mail)->subject('Your order has been placed.');
                }
        );

            $admins = Admins::get();

            for ($i=0; $i < count($admins); $i++) {
                $userAdmin = Users::where('id', $admins[$i]->user_id)->get();

                if (count($userAdmin)==1) {
                    $mail = $userAdmin[0]->email;

                    Mail::send(
                        ['html' => 'mails.basic'],
                        ['content' => 'You have a new order.
                Please visit ',
                'link'=>strval(request()->getHttpHost()),
                'username' => $userAdmin[0]->username],
                        function ($m) use ($mail) {
                            $m->from(
                        'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                        env('APP_NAME', 'Photoshop website')
                    );

                            $m->to($mail)->subject('Your order has been placed.');
                        }
            );
                }
            }

            $this->putMessage($request, 'Order placed successfully.');

            return redirect('/client');
        } else {
            $base_data = $this->get_basic_data($request);

            $ratetablePath = public_path().'/files/configs/ratetable.conf';
            $content = File::get($ratetablePath);

            $base_data['ratetable'] = json_decode($content);

            return view('selfestimation', $base_data);
        }
    }

    public function cancel_order(Request $request)
    {
        $id = intval($request->input('id'));

        if ($id!=null) {
            $temp = Orders::where('id', $id)->get()[0];

            File::delete(public_path().'/files/users/'.$temp->customer_username.'/archive_order'.$temp->id.'.zip');

            $temp->delete();

            $this->putMessage($request, 'Order cancelled successfully.');
        }

        return 'error';
    }

    public function approve_order(Request $request)
    {
        $id = intval($request->input('id'));

        if ($id!=null) {
            $temp = Orders::where('id', $id)->get()[0];
            $temp->confirmed = 1;
            $temp->save();
        }

        return 'error';
    }

    public function confirm_order(Request $request)
    {
        if ($request->isMethod('get')) {
            $base_data = $this->get_basic_data($request);

            $id = $request->input('id');

            $order = Orders::where('id', $id)->get()[0];

            $base_data['order'] = $order;

            if ($order->ready==1&& $order->confirmed == 0) {
                return view('order2', $base_data);
            } else {
                return redirect('/client');
            }
        }
    }

    public function finish_order(Request $request)
    {
        $base_data = $this->get_basic_data($request);

        return view('ordercompletion', $base_data);
    }

    public function get_finished_order(Request $request)
    {
        if ($request->has('id')) {
            $base_data = $this->get_basic_data($request);

            $id = $request->input('id');
            $order= Orders::where('id', $id)->get()[0];

            $base_data['order']=$order;

            return view('finishedorder', $base_data);
        } else {
            return redirect('/client');
        }
    }

    public function get_order_receipt(Request $request)
    {
        $id = $request->input('id');
        $order = Orders::where('id', $id)->get()[0];

        $data = ['order' => $order];
        $pdf = PDF::loadView('pdf.receipt', $data);

        return $pdf->download('receipt-order'.strval($id).'.pdf');
    }
}
