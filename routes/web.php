<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });



Route::get('/', [AdminController::class, 'login'])->name('login');
Route::post('loginVal', [AdminController::class, 'loginVal'])->name('loginVal');
Route::get('logout', [AdminController::class, 'logout'])->name('logout');

// Route::prefix('/')->middleware('AdminMiddleware')->group(function () {
// });



Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('category', [AdminController::class, 'category'])->name('category');


Route::get('product', [AdminController::class, 'product'])->name('product');
Route::post('product/create', [AdminController::class, 'createProduct'])->name('createProduct');
Route::get('product/edit/{id}', [AdminController::class, 'editProduct'])->name('editProduct');
Route::post('product/update', [AdminController::class, 'updateProduct'])->name('updateProduct');
Route::post('product/delete', [AdminController::class, 'deleteProduct'])->name('deleteProduct');

// Route::get('product/create', [AdminController::class, 'createProduct'])->name('product.store');
Route::get('order', [AdminController::class, 'order'])->name('order');
Route::post('getamount', [AdminController::class, 'getAmount'])->name('getAmount');
Route::post('addOrder', [AdminController::class, 'addOrder'])->name('addOrder');
Route::get('orderDatatable', [AdminController::class, 'orderDatatable'])->name('orderDatatable');
Route::post('delete-order', [AdminController::class, 'deleteOrder'])->name('deleteOrder');

Route::get('invoice/{id}', [AdminController::class, 'invoice'])->name('invoice');


// Route::post('login', [AdminController::class, 'login'])->name('admin.login');
