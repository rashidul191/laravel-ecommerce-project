<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWishController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAuthenticate;
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

// Home Page
Route::get('/', [HomeController::class, 'HomePage'])->name('home');
Route::get('/home', [HomeController::class, 'HomePage'])->name('home');

Route::get('/about', function(){
    return view('pages.about');
})->name('about');


// Brand List
Route::get('/BrandList', [BrandController::class, 'BrandList']);

// CategoryList List
Route::get('/CategoryList', [CategoryController::class, 'CategoryList']);

// Product List
Route::get('/ListProductByCategory/{id}', [ProductController::class, 'ListProductByCategory']);
Route::get('/ListProductByBrand/{id}', [ProductController::class, 'ListProductByBrand']);
Route::get('/ListProductByRemark/{remark}', [ProductController::class, 'ListProductByRemark'])->name('ListProductByRemark');
// Product Slider
Route::get('/ListProductSlider', [ProductController::class, 'ListProductSlider']);
// Product Details
Route::get('/ProductDetailsById/{id}', [ProductController::class, 'ProductDetailsById']);
Route::get('/ListReviewByProduct/{product_id}', [ProductController::class, 'ListReviewByProduct']);

// Policy
Route::get('/PolicyByType/{type}', [PolicyController::class, 'PolicyByType']);


// User Auth
Route::get('/UserLogin/{UserEmail}', [UserController::class, 'UserLogin']);
Route::get('/VerifyLogin/{UserEmail}/{OTP}', [UserController::class, 'VerifyLogin']);
Route::get('/Logout', [UserController::class, 'Logout'])->name('Logout');


Route::middleware([TokenAuthenticate::class])->group(function () {

    // Customer Profile
    Route::post('/CreateProfile', [ProfileController::class, 'CreateProfile'])->name('CreateProfile.create');
    Route::get('/ReadProfile', [ProfileController::class, 'ReadProfile'])->name('ReadProfile.show');

    // Customer Review
    Route::post('/CreateProductReview', [ProductController::class, 'CreateProductReview'])->name('CreateProductReview.create');

    // Product Wishlist
    Route::get('/ProductWishList', [ProductWishController::class, 'ProductWishList'])->name('ProductWishList.show');
    Route::put('/CreateWishList/{product_id}', [ProductWishController::class, 'CreateWishList'])->name('CreateWishList.create');
    Route::delete('/RemoveWishList/{product_id}', [ProductWishController::class, 'RemoveWishList'])->name('RemoveWishList.delete');

    // Product Cart
    Route::get('/CartList', [ProductCartController::class, 'CartList'])->name('CartList.show');
    Route::put('/CreateCartList', [ProductCartController::class, 'CreateCartList'])->name('CreateCartList.create');
    Route::delete('/DeleteCartList/{product_id}', [ProductCartController::class, 'DeleteCartList'])->name('DeleteCartList.delete');


    // Invoice
    Route::post('/InvoiceCreate', [InvoiceController::class, 'InvoiceCreate'])->name('InvoiceCreate.create');
});
