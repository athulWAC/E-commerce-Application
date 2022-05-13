<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;

class AdminRepos
{

    public static function ProductInsert($request)
    {


        $data = $request->all();


        if ($request->file('image')) {
            $file = $request->file('image');
            $newfilename = time() . '_' . $file->getClientOriginalName();
            $floc = $file->storeAs('files', $newfilename);
            $data['image']  =   $newfilename;
        } else {
            $data['image']  = " ";
        }

        Product::create($data);
    }


    public static function ProductUpdate($request)
    {
        $id = $request->product_id;


        if ($request->file('image')) {
            $file = $request->file('image');
            $newfilename = time() . '_' . $file->getClientOriginalName();
            $floc = $file->storeAs('files', $newfilename);
            $image['image']  =   $newfilename;
        } else {
            $image['image']  = " ";
        }

        // dd($product);
        Product::where('id', $id)->update([

            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $image['image'],

        ]);
        return;
    }


    public static function Productdelete($request)
    {
        $id = $request->id;
        // dd($id);
        Product::where('id', $id)->delete();
        return;
    }













    public static function orderInsert($request)
    {


        // $order = Order::with('orderDetails')->get();
        // dd($order);
        // $net_amount = $order->orderDetails->productdetails->price;
        // dd($net_amount);



        // dd($request);

        $id = Order::count();
        if ($id == 0) {
            $orderid = 1;
        } else {
            $latest = order::latest()->value('id');
            $orderid =   $latest + 1;
        }

        $count = count($request->product);

        // $order->order_id = $orderid;
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
            // dd($orderdetails);
            $product =  Product::FindOrFail($request->product[$i]);
            $product_price = $product->price * $request->quantity[$i];
            $total_amount += $product_price;
        }
        // dd($total_amount);

        $invoice = new Invoice();
        $invoice->order_id =  $orderid;
        $invoice->total =  $total_amount;
        $invoice->save();

        $order_date = order::latest()->value('created_at');


        $data['total_amount'] = $total_amount;
        $data['orderid'] = $orderid;
        $data['Customer_name'] = $request->customer;
        $data['Phone_number'] = $request->phone;
        $data['order_date'] = $order_date;

        // $invoice =  Invoice::where('id', $orderid)->with('order')->get();
        return  $data;
    }
}
