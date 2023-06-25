<?php

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



Route::get('/blog', function () {
    return view('client.blog');
});

Route::get('/cart', function () {
    return view('client.cart');
});

Route::get('/contact', function () {
    return view('client.contact');
});

Route::get('/createacc', function () {
    return view('client.auth.create_acc');
});

Route::get('/shop', function () {
    return view('client.shop');
});

Route::get('/singleblog', function () {
    return view('client.single_blog');
});

Route::get('/test',[\App\Http\Controllers\Client\Invoice\InvoiceController::class,'test']);

Route::get('/',[\App\Http\Controllers\Client\Home\HomeController::class,'index']);
Route::get('/product/{id}',[\App\Http\Controllers\Client\Home\HomeController::class, 'show']);

Route::get('/order/{id}',[\App\Http\Controllers\Client\Auth\CustomerController::class, 'view']);

Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Client\Auth\CustomerController::class, 'login'])->name('login');


Route::get('registration', [\App\Http\Controllers\Client\Auth\CustomerController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [\App\Http\Controllers\Client\Auth\CustomerController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [\App\Http\Controllers\Client\Auth\CustomerController::class, 'signOut'])->name('signout');

Route::get('success',[\App\Http\Controllers\Client\Home\HomeController::class, 'success'])->name('success');
Route::get('fail',[\App\Http\Controllers\Client\Home\HomeController::class, 'fail'])->name('fail');


Route::post('guest/create',[\App\Http\Controllers\Client\Auth\CustomerController::class,'createGuest']);
