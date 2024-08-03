<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserOrderController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Product::query()->latest('id')->with('category')->limit(30)->get();
    return view('welcome',compact('products'));
})->name('welcome');

// Chi tiết sản phẩm
Route::get('product/{slug}' ,[ProductController::class, 'detail'])->name('product.detail');

// mua hàng
Route::post('cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('cart/list', [\App\Http\Controllers\CartController::class, 'list'])->name('cart.list');
Route::post('order/add', [\App\Http\Controllers\OrderController::class, 'add'])->name('order.add');
Route::get('order/list', [\App\Http\Controllers\OrderController::class, 'list'])->name('order.list');


Route::get('auth/register', [RegisterController::class, 'index'])
    ->name('register');
Route::post('auth/register', [RegisterController::class, 'register'])
    ->name('register');

Route::get('auth/verify/{token}', [LoginController::class, 'verify'])
    ->name('verifyEmail');
Route::get('auth/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('auth/login', [LoginController::class, 'login'])
    ->name('login');
Route::get('auth/logout', [LoginController::class, 'logout'])
    ->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    });
