<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return inertia('MainLayout');
});
Route::get('/products', function () {
    return inertia('Products');
});
Route::get('/home', function () {
    return inertia('Home');
});
Route::get('/transaction', function () {
    return inertia('Transaction');
});
Route::get('/faq', function () {
    return inertia('Faq');
});
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
