<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Razorpay\Api\Api;
use App\Models\Payment;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\Session;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RazorpayPayController extends Controller
{
public function payWithRazorpay()
{
// dd(env('RAZOR_KEY'));
return view('pages.paymentview');
}

public function confirm(Request $request)
{
$input = $request->all();
// dd($input);
$api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

$receiptId = Str::random(20);

$order = $api->order->create([
'receipt' => $receiptId,
'amount' => $request->all()['amount'] * 100,
'currency' => 'INR',
]);

$response = [
'orderId' => $order['id'],
'razorpayId' => env('RAZOR_KEY'),
'amount' => $request->all()['amount'] * 100,
'name' => $request->all()['name'],
'currency' => 'INR',
'email' => $request->all()['email'],
'description' => 'Testing description',
];

return view('pages.razorpayView', compact('response'));
}

public function payment(Request $request)
{
$input = $request->all();
// dd($input);
$api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

$payment = $api->payment->fetch($request->razorpay_payment_id);
// dd($payment);
if (count($input) && !empty($input['razorpay_payment_id'])) {
try {
$payment->capture(['amount' => $payment['amount']]);
} catch (\Exception $e) {
return $e->getMessage();

// return redirect()->back();
}
}
$attributes = [
'razorpay_signature' => $request->razorpay_signature,
'razorpay_payment_id' => $request->razorpay_payment_id,
'razorpay_order_id' => $request->razorpay_order_id,
];
$order = $api->utility->verifyPaymentSignature($attributes);

$payInfo = [
'razorpay_signature' => $request->razorpay_signature,
'r_payment_id' => $request->razorpay_payment_id,
'razorpay_order_id' => $request->razorpay_order_id,
'user_id' => Auth::user()->id,
'amount' => $request->amount,
'created_at' => Carbon::now(),
];
// dd($payInfo);

$data = Payment::insertGetId($payInfo);
//dd($data);
// Session::put('success', 'Payment successful');
// return response()->json(['success' => 'Payment successful']);

if (!$data) {
return response()->json(['status' => '0', 'error' => 'Payment failed. please try again']);
} else {
return response()->json(['status' => '1', 'success' => 'Payment successful']);
}
}
}
////////////////////////////////////////////////////////
///////////////////////////////////////////////////////


$('body').on('click', '#rzp-button1', function(e) {
            e.preventDefault();
            // var amount = $('#amount').val();
            // var total_amount = amount * 100;
            var key = $('#key').val();
            var total_amount = $('#amount').val();
            var orderid = $('#orderid').val();
            console.log('hi');
            var options = {
                "key": key, // Enter the Key ID generated from the Dashboard
                "amount": total_amount, // Amount is in currency subunits. Default currency is INR. Hence, 10 refers to 1000 paise
                "currency": "INR",
                "name": "Athul",
                "description": "Test Transaction",
                "image": "https://www.nicesnippets.com/image/imgpsh_fullsize.png",
                "order_id": orderid, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function(response) {
                    console.log('inside');
                    console.log(orderid);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('payment') }}",
                        data: {
                            razorpay_payment_id: response.razorpayId,
                            amount: amount
                        },
                        success: function(data) {
                            $('.success-message').text(data.success);
                            $('.success-alert').fadeIn('slow', function() {
                                $('.success-alert').delay(5000).fadeOut();
                            });
                            $('.amount').val('');
                        }
                    });
                },

                "notes": {
                    "address": "test test"
                },
                "theme": {
                    "color": "#F37254"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
