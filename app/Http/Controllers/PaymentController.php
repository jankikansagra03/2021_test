<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use Monolog\SignalHandler;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment_form');
    }
    public function success()
    {
        return view('success');
    }

    public function payment(Request $request)
    {

        $name = $request->input('username');
        $amount = $request->input('amount');
        $email = $request->input('email');

        $api = new Api('rzp_test_2B7SjKnlI8d1lM', 'IlAM5TyllWOyu6Vtor4bDZie');
        $order  = $api->order->create(array('receipt' => '123', 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order
        $orderId = $order['id'];

        $user_pay = new Payments();

        $user_pay->username = $name;
        $user_pay->amount = $amount;
        $user_pay->user_email = $email;
        $user_pay->payment_id = $orderId;
        $user_pay->save();

        $data = array(
            'order_id' => $orderId,
            'amount' => $amount
        );

        Session::put('order_id', $orderId);
        Session::put('amount', $amount);


        return redirect('/payment_form')->with('data', $data);
    }


    public function pay(Request $request)
    {
        $data = $request->all();
        $user = Payments::where('payment_id', $data['razorpay_order_id'])->first();
        $user->payment_done = true;
        $user->razorpay_id = $data['razorpay_payment_id'];

        $api = new Api('rzp_test_CcRYorXwUKnx5y', 'SqHYHxVK94qmGBXwy717KHUl');


        try {
            $attributes = array(
                'razorpay_signature' => $data['razorpay_signature'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_order_id' => $data['razorpay_order_id']
            );
            $order = $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (SignatureVerificationError $e) {

            $succes = false;
        }


        if ($success) {
            $user->save();
            return redirect('/success');
        } else {

            return redirect()->route('error');
        }
    }


    public function error()
    {
        return view('error');
    }
}
