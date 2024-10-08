<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ComplaintController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//AUTH
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login'])->name('login');
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});

//MASTER PROFILE
Route::get('profile', [AuthController::class,'index']);
Route::get('profile/{id}', [AuthController::class,'show']);

//MASTER COMPANY
Route::get('company', [CompanyController::class,'index']);
Route::get('company/{id}', [CompanyController::class,'show']);

//MASTER PACKAGING
Route::get('packaging', [PackagingController::class,'index']);
Route::get('packaging/{id}', [PackagingController::class,'show']);

//MASTER PRODUCT
Route::get('product', [ProductController::class,'index']);
Route::get('product/{id}', [ProductController::class,'show']);

//CUSTOMERS PRODUCT
Route::get('customerproduct', [CustomerProductController::class,'index']);
Route::get('customerproduct/{id}', [CustomerProductController::class,'show']);

Route::middleware(["admin"])->group(function (){
    //MASTER COMPANY
    Route::post('company', [CompanyController::class,'store']);
    Route::patch('company/{id}', [CompanyController::class,'update']);
    Route::delete('company/{id}', [CompanyController::class,'destroy']);

    //MASTER PACKAGING
    Route::post('packaging', [PackagingController::class,'store']);
    Route::patch('packaging/{id}', [PackagingController::class,'update']);
    Route::delete('packaging/{id}', [PackagingController::class,'destroy']);

    //MASTER PRODUCT
    Route::post('product', [ProductController::class,'store']);
    Route::patch('product/{id}', [ProductController::class,'update']);
    Route::delete('product/{id}', [ProductController::class,'destroy']);

    // CUSTOMERS PRODUCT
    Route::post('customerproduct', [CustomerProductController::class,'store']);
    Route::patch('customerproduct/{id}', [CustomerProductController::class,'update']);
    Route::delete('customerproduct/{id}', [CustomerProductController::class,'destroy']);

});
Route::middleware(['retail'])->group(function() {
    // CART
    Route::get('cart', [CartController::class,'index']);
    Route::get('cart/{id}', [CartController::class,'show']);
    Route::post('cart', [CartController::class,'store']);
    Route::patch('cart/{id}', [CartController::class,'update']);
    Route::delete('cart/{id}', [CartController::class,'destroy']);

    // COMPLAINT
    Route::get('complaint', [ComplaintController::class,'index']);
    Route::get('complaint/{id}', [ComplaintController::class,'show']);
    Route::post('complaint', [ComplaintController::class,'store']);
    Route::patch('complaint/{id}', [ComplaintController::class,'update']);
    Route::delete('complaint/{id}', [ComplaintController::class,'destroy']);

    //ORDER
    Route::get('order', [OrderController::class,'index']);
    Route::get('order/{id}', [OrderController::class,'show']);
    Route::post('order', [OrderController::class,'store']);
    Route::patch('order/{id}', [OrderController::class,'update']);
    Route::delete('order/{id}', [OrderController::class,'destroy']);
});


// Route::middleware('auth:api')->group(function () { });

Route::get('/storage/image/{filename}', function ($filename) {
    $path = storage_path('app/image/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    return response()->file($path);
});
