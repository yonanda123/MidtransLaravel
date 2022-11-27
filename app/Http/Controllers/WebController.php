<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request){
        return view ('index');
    }
    public function payment(Request $request){
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Eorder(accept real order).
        // Set to Development/Sandbox Environment (default). Set to true for Production Egross_amountcept reagross_amount.
        // Set to Development/Sandbox Environment (default). Set to true for Productionpayment_typentcept reagross_amount.
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 18000,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => '10000',
                    'quantity' => 1,
                    'name' => 'Apel'
                ],[
                    'id' => 'b1',
                    'price' => '8000',
                    'quantity' => 1,
                    'name' => 'Jeruk'
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->get('uname'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('nomor'),
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('payment', ['snap_token' => $snapToken]);
    }

    public function payment_post(Request $request){
        $json = json_decode($request->get('json'));
        $order = new Order();
        $order->status = $json->transaction_status;
        $order->uname = $request->get('uname');
        $order->email = $request->get('email');
        $order->nomor = $request->get('nomor');
        $order->transaction_id = $json->transaction_id;
        $order->order_id = $json->order_id;
        $order->gross_amount = $json->gross_amount;
        $order->payment_type = $json->payment_type;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        return $order->save() ? redirect(url('/'))->with('alert-success','Order Berhasil dibut') : redirect(url('/'))->with('alert-failed','Terjadi kesalahan');
    }
}
