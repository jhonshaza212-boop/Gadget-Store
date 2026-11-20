<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Route Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Route Khusus ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Products
    Route::resource('/products', ProductController::class);

    // Categories
    Route::resource('/categories', CategoryController::class);

    // Orders
    Route::get('/orders', [CustomerController::class, 'adminOrders'])
        ->name('admin.orders');

    // Update status pesanan
    Route::patch('/orders/{order}/status', [CustomerController::class, 'updateOrderStatus'])
        ->name('admin.orders.status');
});


/*
|--------------------------------------------------------------------------
| Route Khusus CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Halaman utama customer
    Route::get('/customer', [CustomerController::class, 'index'])
        ->name('customer.home');

    // Detail produk
    Route::get('/customer/products/{product}', [CustomerController::class, 'show'])
        ->name('customer.products.show');


    /*
    |--------------------------------------------------------------------------
    | Keranjang
    |--------------------------------------------------------------------------
    */

    // Lihat keranjang
    Route::get('/customer/cart', [CustomerController::class, 'cart'])
        ->name('customer.cart');

    // Tambah produk ke keranjang
    Route::post('/customer/cart/add/{product}', [CustomerController::class, 'addToCart'])
        ->name('customer.cart.add');

    // Update jumlah produk
    Route::patch('/customer/cart/update/{id}', [CustomerController::class, 'updateCart'])
        ->name('customer.cart.update');

    // Hapus produk dari keranjang
    Route::delete('/customer/cart/remove/{id}', [CustomerController::class, 'removeFromCart'])
        ->name('customer.cart.remove');


    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    // Halaman checkout
    Route::get('/customer/checkout', [CustomerController::class, 'checkout'])
        ->name('customer.checkout');

    // Proses checkout
    Route::post('/customer/checkout', [CustomerController::class, 'placeOrder'])
        ->name('customer.checkout.place');


    /*
    |--------------------------------------------------------------------------
    | Riwayat Pesanan
    |--------------------------------------------------------------------------
    */

    // Melihat pesanan customer
    Route::get('/customer/orders', [CustomerController::class, 'orders'])
        ->name('customer.orders');
});


/*
|--------------------------------------------------------------------------
| Route Login / Register Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';