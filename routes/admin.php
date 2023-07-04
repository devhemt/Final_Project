<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('admin.dashboard');
});

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('/category/show',[\App\Http\Controllers\Admin\Category\CategoryController::class,'show']);
Route::get('/supplier/show',[\App\Http\Controllers\Admin\Supplier\SupplierController::class,'show']);
Route::get('/purchase/show',[\App\Http\Controllers\Admin\Purchase\PurchaseController::class,'show']);
Route::get('/purchase/{id}',[\App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'purchaseDetail']);
Route::get('/purchase/addnewproduct/{id}',[\App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'addNewProduct']);
Route::post('/purchase/saveproduct',[\App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'store']);
Route::get('/purchase/addnewproduct/{prd_id}/{purchase_id}',[\App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'addOldProduct']);
Route::post('/purchase/addold',[\App\Http\Controllers\Admin\Purchase\PurchaseController::class, 'addOld']);

Route::get('/signout', [\App\Http\Controllers\Admin\Profile\AdminAccountController::class,'signOut']);

Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Admin\Profile\AdminAccountController::class, 'login']);

Route::get('/product',[\App\Http\Controllers\Admin\Product\ProductController::class, 'index']);
Route::get('/product/{id}',[\App\Http\Controllers\Admin\Product\ProductController::class,'show']);
Route::get('/product/{product}/edit',[\App\Http\Controllers\Admin\Product\ProductController::class,'edit']);
Route::post('/product/edit',[\App\Http\Controllers\Admin\Product\ProductController::class,'update']);


Route::get('/profile',[\App\Http\Controllers\Admin\Profile\AdminAccountController::class,'index']);
Route::post('/profile',[\App\Http\Controllers\Admin\Profile\AdminAccountController::class,'store']);
Route::get('/profile/create',[\App\Http\Controllers\Admin\Profile\AdminAccountController::class,'create']);
Route::get('/profile/showall',[\App\Http\Controllers\Admin\Profile\AdminAccountController::class,'showall']);

Route::get('/customer_order', [\App\Http\Controllers\Admin\Order\OrderController::class, 'customer']);
Route::get('/guest_order', [\App\Http\Controllers\Admin\Order\OrderController::class, 'guest']);
Route::get('/order/{id}', [\App\Http\Controllers\Admin\Order\OrderController::class, 'show']);

Route::get('/lowproduct/{amount}',[\App\Http\Controllers\Admin\Dashboard\DashboardController::class,'lowProduct']);
Route::get('/newcustomer/{time}',[\App\Http\Controllers\Admin\Dashboard\DashboardController::class,'customer']);
Route::get('/revenue/{time}',[\App\Http\Controllers\Admin\Dashboard\DashboardController::class,'revenue']);
Route::get('/topcity/{time}',[\App\Http\Controllers\Admin\Dashboard\DashboardController::class,'topCity']);
Route::get('/topproduct/{time}',[\App\Http\Controllers\Admin\Dashboard\DashboardController::class,'topProduct']);

Route::get('/create/customer',[\App\Http\Controllers\Admin\Customer\CustomerController::class, 'create']);
Route::post('/create_customer',[\App\Http\Controllers\Admin\Customer\CustomerController::class, 'store']);
Route::get('/showcustomer/{type}',[\App\Http\Controllers\Admin\Customer\CustomerController::class, 'show']);







