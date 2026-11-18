<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;




Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('products', ProductController::class)->except(['show']);