<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');

});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');