<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminRepos
{

    public static function ProductInsert($request)
    {


        $data = $request->all();


        if ($request->file('image')) {
            $file = $request->file('image');
            $newfilename = time() . '_' . $file->getClientOriginalName();
            Storage::putFileAs('/assets/products/', $request->file('image'), $newfilename);
            $data['image']  =   $newfilename;
        } else {
            $data['image']  = " ";
        }

        return  Product::create($data);
    }


    public static function ProductUpdate($request)
    {
        $id = $request->product_id;

        if ($request->file('image')) {
            $file = $request->file('image');
            $newfilename = time() . '_' . $file->getClientOriginalName();
            Storage::putFileAs('/assets/products/', $request->file('image'), $newfilename);

            // $floc = $file->storeAs('files', $newfilename);
            // Storage::putFileAs('/assets/products/', $request->file('image'));

            $image['image']  =   $newfilename;
        } else {
            $image['image']  = " ";
        }


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

        foreach ($request->id as $id) {
            // $id = $request->id;
            Product::where('id', $id)->delete();
        }


        return;
    }



    public static function orderInsert($request)
    {
        // dd($request);
        $id = Order::count();
        if ($id == 0) {
            $orderid = 1;
        }

        $count = count($request->product);
        // dd($count);

        $order = new Order();
        $order->customer_name = $request->customer;
        $order->phone = $request->phone;
        $order->status = 1;
        $order->save();

        $orderid = order::latest()->value('id');

        $total_amount = 0;
        for ($i = 0; $i < $count; $i++) {

            if ($request->product[$i] == null) {
                $i = $i + 1;
            } else {
                $orderdetails = new OrderDetails();
                $orderdetails->order_id = $orderid;
                $orderdetails->product_id = $request->product[$i];
                $orderdetails->quantity = $request->quantity[$i];
                $orderdetails->save();
                $product =  Product::FindOrFail($request->product[$i]);
                $product_price = $product->price * $request->quantity[$i];
                $total_amount += $product_price;
            }
        }


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



    public static function orderDelete($request)
    {
        $order_id = $request->id;
        $order_delete =  Order::where('id', $order_id)->delete();
        return $order_delete;
    }


    public static function invoiceView($id)
    {
        $invoice_id = $id;
        $invoice = Invoice::with('order')->where('id', $invoice_id)->first();
        return $invoice;
    }
}
