<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\Product;
use Razorpay\Api\Order as ApiOrder;
use Session;
use Redirect;

class RazorpayController extends Controller
{


    public function index()
    {
        $products = Product::get();
        return view('razorpayorder', compact('products'));
    }


    public function payWithRazorpay()
    {
        return view('payWithRazorpay');
    }




    public function payment(Request $request)
    {
        dd($request);
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        $payInfo = [
            'payment_id' => $request->razorpay_payment_id,
            'user_id' => '1',
            'amount' => $request->amount,
        ];

        Payment::insertGetId($payInfo);

        \Session::put('success', 'Payment successful');

        return response()->json(['success' => 'Payment successful']);
    }




    public function confirm(Request $request)
    {
        // dd(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'), env('MAIL_FROM_ADDRESS'));
        // dd(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpay_key = env('RAZORPAY_KEY');
        $razorpay_secret = env('RAZORPAY_SECRET');


        $id = Order::count();
        if ($id == 0) {
            $orderid = 1;
        } else {
            $latest = order::latest()->value('id');
            $orderid =   $latest + 1;
        }

        $count = count($request->product);

        $order = new Order();
        $order->id = $orderid;
        $order->customer_name = $request->customer;
        $order->phone = $request->phone;
        $order->save();


        $total_amount = 0;
        for ($i = 0; $i < $count; $i++) {
            $orderdetails = new OrderDetails();
            $orderdetails->order_id = $orderid;
            $orderdetails->product_id = $request->product[$i];
            $orderdetails->quantity = $request->quantity[$i];
            $orderdetails->save();

            $product =  Product::FindOrFail($request->product[$i]);
            $product_price = $product->price * $request->quantity[$i];
            $total_amount += $product_price;
        }
        // dd($total_amount);

        $invoice = new Invoice();
        $invoice->order_id =  $orderid;
        $invoice->total =  $total_amount;
        $invoice->save();

        $order_date = Order::latest()->value('created_at');
        $data['total_amount'] = $total_amount;
        $data['orderid'] = $orderid;
        $data['Customer_name'] = $request->customer;
        $data['Phone_number'] = $request->phone;
        $data['order_date'] = $order_date;


        // dd(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $api = new Api($razorpay_key, $razorpay_secret);
        $receiptId = \Str::random(20);

        // $apiorder = new ApiOrder;
        $order = $api->Order->create([
            'receipt' => $receiptId,
            'amount' => $data['total_amount'] * 100,
            'currency' => 'INR',
        ]);



        $response = [
            'orderId' => $order['id'],
            'razorpayId' => env('RAZORPAY_KEY'),
            'amount' => $data['total_amount'] * 100,
            'name' =>  $data['Customer_name'],
            'currency' => 'INR',
            'email' => 'athul.k@webandcrafts.in',
            'description' => 'Testing description',
        ];

        return view('paywithrazorpay', compact('response'));

        dd('hi');
        // return  $data;
    }
}
