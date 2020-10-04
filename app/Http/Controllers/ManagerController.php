<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Orders;
use File;
use Mail;
use PDF;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function index(Request $request){

      $data = $this->get_basic_admin_data($request);

      $orders = Orders::whereNull('finished_date')->where('ready', 0)->get();

      $data['orders']=$orders;

      return view('admin.orders', $data);
    }

    public function show(Request $request, $aux){
      $data = $this->get_basic_admin_data($request);

      switch ($aux) {

        case 'deliveries':
          return $this->deliveries($request);
          break;

        case 'client-list':
          return $this->clients($request);
          break;

        case 'get-order-data':
          return $this->get_order_data($request);
          break;

        case 'set-order-price':
          return $this->set_order_price($request);
          break;

        case 'send-message':
          return $this->send_message($request);
          break;

        case 'get-order-receipt':
          return $this->get_order_receipt($request);
          break;

        case 'upload-project':
          return $this->upload_project($request);
          break;

        default:
          return view('admin.'.$aux, $data);
          break;
      }
    }

    public function deliveries(Request $request){
      $data = $this->get_basic_admin_data($request);

      $orders = Orders::where('confirmed', 1)->whereNull('finished_date')->get();

      $data['orders']=$orders;

      return view('admin.delivery', $data);
    }

    public function get_order_data(Request $request){

      $id = intval($request->input('id'));

      $order = Orders::where('id', $id)->get()[0];

      $pause = "<-#abc pause cba#->";

      echo $order->img_nr.$pause;
      echo $order->notes.$pause;

      if($order->format != NULL){
        echo '1'.$pause.$order->format.$pause;
      }else{
        echo '0'.$pause;
      }

      echo $order->background.$pause;
      echo $order->eps.$pause;

      if($order->resolution_change != 0){
        echo '1'.$pause.$order->res_x.$pause.$order->res_y.$pause;
      }else{
        echo '0'.$pause;
      }
      echo $order->rgb_to_cmyk.$pause;
      echo $order->price.$pause;
    }

    public function set_order_price(Request $request){
      if($request->isMethod('post')){
        $id = intval($request->input('id'));
        $price = intval($request->input('value'));

        $order = Orders::where('id', $id)->get()[0];
        $order->price=$price;
        $order->ready=1;
        $order->save();
      }
    }

    public function send_message(Request $request){
      if($request->isMethod('post')){
        $id = intval($request->input('id'));

        $comment='';
        if($request->has('comment')){
          $comment = strval($request->input('comment'));
        }

        $order = Orders::where('id', $id)->get()[0];
        $user = Users::where('username', $order->customer_username)->get()[0];

        $mail = $user->email;

        Mail::send(
            ['html' => 'mails.basic'],
            ['content' => (trim($comment)!=''?'Message from manager: "'.$comment.'".':'')
            .'You must confirm your new order by entering on the link below,',
            'link'=>strval(request()->getHttpHost().'/client/confirm-order?id='.$id),
            'username' => $user->username],
            function ($m) use ($mail) {
                $m->from(
                    'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                    env('APP_NAME', 'Photoshop website')
                );

                $m->to($mail)->subject('Confirm your order.');
            }
        );

      }
    }

    public function get_order_receipt(Request $request){
        $id = $request->input('id');
        $order = Orders::where('id', $id)->get()[0];

        $data = ['order' => $order];
        $pdf = PDF::loadView('pdf.receipt', $data);

        return $pdf->download('receipt-order'.strval($id).'.pdf');
    }

    public function upload_project(Request $request){
      $id = $request->input('id');
      $file = $request->file('archive');

      $order = Orders::where('id', $id)->get()[0];
      $order->finished_date = Carbon::now();
      $order->save();

      $destinationPath = public_path().'/files/users/'.$order->customer_username;

      $file->move($destinationPath,'order_complete'.strval($order->id).'.zip');

      File::delete(
        public_path().'/files/users/'.$order->customer_username.'/archive_order'.$order->id.'.zip');

      $user = Users::where('username', $order->customer_username)->get()[0];
      $mail = $user->email;

      Mail::send(
          ['html' => 'mails.basic'],
          ['content' => 'Your order is ready! Please enter the link below to get your product.',
          'link'=>strval(request()->getHttpHost().'/client/get-finished-order?id='.$id),
          'username' => $user->username],
          function ($m) use ($mail) {
              $m->from(
                  'noreply@sandbox878fe7112a6e4af5932d57f7c39d790b.mailgun.org',
                  env('APP_NAME', 'Photoshop website')
              );

              $m->to($mail)->subject('Confirm your order.');
          }
      );
    }

    public function clients(Request $request){
      $data = $this->get_basic_admin_data($request);

      $clients = Users::get();
      $data['users'] = $clients;

      $orders_nr = [];

      foreach($clients as $client){
        $order_nr = count(Orders::where('customer_username', $client->username)->whereNotNull('finished_date')->get());

        $orders_nr[$client->username] = $order_nr;
      }

      $data['orders_nr']=$orders_nr;

      return view('admin.clients', $data);

    }
}
