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

Route::get('/signout', [\App\Http\Controllers\AdminAccountController::class,'signOut']);

Route::match(['get', 'post'], '/login', [\App\Http\Controllers\AdminAccountController::class, 'login']);

Route::get('/product',[\App\Http\Controllers\Admin\Product\ProductController::class, 'index']);
Route::get('/product/{id}',[\App\Http\Controllers\Admin\Product\ProductController::class,'show']);
Route::get('/product/{product}/edit',[\App\Http\Controllers\Admin\Product\ProductController::class,'edit']);
Route::post('/product/edit',[\App\Http\Controllers\Admin\Product\ProductController::class,'update']);

//old route

Route::get('/addbatch/{id}', [\App\Http\Controllers\Admin\Product\ProductController::class,'batch']);

Route::get('/allorder', [\App\Http\Controllers\InvoiceController::class, 'index6']);
Route::get('/canceledorder', [\App\Http\Controllers\InvoiceController::class, 'index0']);
Route::get('/noprocessorder', [\App\Http\Controllers\InvoiceController::class, 'index1']);
Route::get('/confirmedorder', [\App\Http\Controllers\InvoiceController::class, 'index2']);
Route::get('/packingorder', [\App\Http\Controllers\InvoiceController::class, 'index3']);
Route::get('/deliveryorder', [\App\Http\Controllers\InvoiceController::class, 'index4']);
Route::get('/successfulorder', [\App\Http\Controllers\InvoiceController::class, 'index5']);
Route::get('/order/{id}/{type}', [\App\Http\Controllers\InvoiceController::class, 'show']);


Route::post('/invoice',[\App\Http\Controllers\InvoiceController::class, 'store']);



Route::post('/product',[\App\Http\Controllers\Admin\Product\ProductController::class, 'store']);
Route::get('product/create',[\App\Http\Controllers\Admin\Product\ProductController::class,'create']);
Route::post('/product/addbatch',[\App\Http\Controllers\Admin\Product\ProductController::class,'batchinside']);



Route::get('/profile',[\App\Http\Controllers\AdminAccountController::class,'index']);
Route::post('/profile',[\App\Http\Controllers\AdminAccountController::class,'store']);
Route::get('/profile/create',[\App\Http\Controllers\AdminAccountController::class,'create']);
Route::get('/profile/showall',[\App\Http\Controllers\AdminAccountController::class,'showall']);


