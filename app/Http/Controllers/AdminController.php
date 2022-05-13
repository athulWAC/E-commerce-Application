<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDatatable;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\AdminRepos;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $categories = Category::get();
        // dd($category);
        return $dataTable->render('product', compact('products', 'categories'));
    }


    public function createProduct(Request $request)
    {


        $request->validate([
            'name' => 'required',

        ]);

        AdminRepos::ProductInsert($request);

        return redirect()->back();
    }



    public function editProduct(Request $request, $id)
    {
        // dd($request);
        // dd($id);
        $products  =  Product::where('id', $id)->first();
        $categories  =  Category::get();
        return view('editProduct', compact('products', 'categories'));
    }


    public function updateProduct(Request $request)
    {
        AdminRepos::ProductUpdate($request);
        return redirect()->route('product');
    }

    public function deleteProduct(Request $request)
    {
        dd($request);
        AdminRepos::Productdelete($request);
        return redirect()->route('product');
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
        return view('order', compact('products'));
    }


    public function addOrder(Request $request)
    {
        $invoices = AdminRepos::orderInsert($request);
        return view('invoice', compact('invoices'));
    }

    // public function addOrder(Request $request)
    // {
    //     $invoive = AdminRepos::orderInsert($request);
    //     return redirect()->back();
    // }
    // invoice



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
