<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;

class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('razorpayView');
    }


    // payment from rayzorpay module


    public function store(Request $request)
    {
        // dd($request);
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        dd($payment['amount']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->back();
    }



    // payment from order table


    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {

                $payment->capture(array('amount' => $payment['amount']));
            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        $payInfo = [
            'payment_id' => $request->razorpay_payment_id,
            'user_id' => '1',
            'amount' => $request->amount,
        ];

        Payment::insertGetId($payInfo);

        \Session::put('success', 'Payment successful');

        return response()->json(['success' => 'Payment successful']);
    }
}
