<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDatatable;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductEmailNotification;
use App\Repositories\AdminRepos;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{

    // public $productRepo;

    // public function __construct(ProductRepository $productRepo)
    // {
    //     $this->productRepo = $productRepo;
    // }

    // $this->productRepo->virtualStockCount($product);


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }


    public function loginVal(Request $request)
    {


        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);


        $adminCredentials =  $request->only('email', 'password');


        if (Auth::attempt($adminCredentials)) {
            return redirect()->route('product');
        } else {
            return redirect()->back()->with('error', 'wrong email or password');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('layout');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        return view('category');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product(ProductDatatable $dataTable)
    {
        $products = Product::with('category')->get();

        // dd($products);
        $categories = Category::get();
        return $dataTable->render('product', compact('products', 'categories'));
    }


    public function createProduct(Request $request)
    {


        $request->validate([
            'name' => 'required',

        ]);

        $product = AdminRepos::ProductInsert($request);




        $user = User::first();
        $message = [
            'greeting' => 'Hi ' . $user->name . ',',
            'body' => 'you have added a new product',
            'thanks' => 'Thank you for adding a product',
            'actionText' => ' add product',
            'actionURL' => url('http://localhost/invoice-system/product'),
            'id' => 57,
            'product' => $product,
        ];
        Notification::send($user, new ProductEmailNotification($message));
        return redirect()->back();
    }



    public function editProduct(Request $request, $id)
    {
        // dd($request);
        // dd($id);
        $products  =  Product::where('id', $id)->first();
        $categories  =  Category::get();
        return view('editProduct', compact('products', 'categories'));
        // return;
    }


    public function updateProduct(Request $request)
    {
        AdminRepos::ProductUpdate($request);
        return;
    }

    public function deleteProduct(Request $request)
    {
        // dd($request);
        AdminRepos::Productdelete($request);
        return redirect()->route('product');
    }

    public function orderDatatable(Request $request)
    {
        // dd($request);
        $draw = $request->get('draw');
        $search = $request->get('search');
        $statusfilter = $request->get('status');
        $statusfilter = $request->get('status');
        $sortColumn = $request->order[0]['column'] ?? 3;
        $sortDir = ($request->order[0]['dir'] ?? 'desc') == 'desc' ? 'DESC' : 'ASC';

        // $invoice = new order;
        $order = Order::select([
            'invoices.id as invoice_id',
            'invoices.total',
            'invoices.created_at',
            'orders.customer_name',
            'orders.phone',
            'orders.id as order_id'

        ]);

        $invoice =  $order->leftJoin('invoices', 'invoices.order_id', '=', 'orders.id');
        $total_request =    $invoice->count();


        if (!empty($search)) {
            $order->where(function ($qry) use ($search) {
                $qry->orWhere('invoices.id', 'like', "%$search%");
                $qry->orWhere('invoices.total', 'like', "%$search%");
                $qry->orWhere('orders.customer_name', 'like', "%$search%");
                $qry->orWhere('orders.phone', 'like', "%$search%");
                $qry->orWhere('orders.id', 'like', "%$search%");
            });
        }
        $invoice = $order->get();


        $filteredCount = $invoice->count();

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_request,
            'recordsFiltered' => $filteredCount,
            'data' => $invoice,
        );
        return response()->json($data);
    }



    public function editOrder(Request $request)
    {
        dd($request);
        $data =  AdminRepos::orderDelete($request);
        return response()->json($data);
    }




    public function deleteOrder(Request $request)
    {
        $data =  AdminRepos::orderDelete($request);
        return response()->json($data);
    }

    public function invoice($id)
    {
        // dd($id);
        $invoice =  AdminRepos::invoiceView($id);
        return view('invoice', compact('invoice'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $products = Product::get();

        $product_id = 3;
        $order = Order::with('orderDetails')
            ->whereHas('orderDetails', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            })->get();

        // dd($order);

        return view('order', compact('products'));
    }


    public function addOrder(Request $request)
    {
        // dd($request);
        $request->validate([
            'customer' => 'required',
            'phone' => 'required',
        ]);

        AdminRepos::orderInsert($request);
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAmount(Request $request)
    {
        $id = $request->id;
        $amount = Product::where('id', $id)->value('price');
        return $amount;
        // dd($amount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
