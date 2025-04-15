<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

// Brand List
Route::get('/BrandList', [BrandController::class, 'BrandList']);

// CategoryList List
Route::get('/CategoryList', [CategoryController::class, 'CategoryList']);

// Product List
Route::get('/ListProductByCategory/{id}', [ProductController::class, 'ListProductByCategory']);
Route::get('/ListProductByBrand/{id}', [ProductController::class, 'ListProductByBrand']);
Route::get('/ListProductByRemark/{remark}', [ProductController::class, 'ListProductByRemark']);
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
Route::get('/Logout', [UserController::class, 'Logout']);


Route::middleware([TokenAuthenticate::class])->group(function () {

    // Customer Profile
    Route::post('/CreateProfile', [ProfileController::class, 'CreateProfile']);
    Route::get('/ReadProfile', [ProfileController::class, 'ReadProfile']);

    // Customer Review
    Route::post('/CreateProductReview', [ProductController::class, 'CreateProductReview']);

    // Product Wishlist
    Route::get('/ProductWishList', [ProductWishController::class, 'ProductWishList']);
    Route::put('/CreateWishList/{product_id}', [ProductWishController::class, 'CreateWishList']);
    Route::delete('/RemoveWishList/{product_id}', [ProductWishController::class, 'RemoveWishList']);

    // Product Cart
    Route::get('/CartList', [ProductCartController::class, 'CartList']);
    Route::put('/CreateCartList', [ProductCartController::class, 'CreateCartList']);
    Route::delete('/DeleteCartList/{product_id}', [ProductCartController::class, 'DeleteCartList']);
});
