<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'prevent-back-history']], function () {
//     Route::get('/add-product', [ProductController::class, 'index'])->name('product.index');
// });

Route::middleware('admin')
    ->prefix('admin')
    ->group(function () {
        Route::get('/add-product', [ProductController::class, 'index'])->name('product.index');
    });
