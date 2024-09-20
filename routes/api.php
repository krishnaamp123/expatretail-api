<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PackagingController;

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

//MASTER COMPANY
Route::get('company', [CompanyController::class,'index']);
Route::get('company/{id}', [CompanyController::class,'show']);
Route::post('company', [CompanyController::class,'store']);
Route::patch('company/{id}', [CompanyController::class,'update']);
Route::delete('company/{id}', [CompanyController::class,'destroy']);

//MASTER
Route::get('packaging', [PackagingController::class,'index']);
Route::get('packaging/{id}', [PackagingController::class,'show']);
Route::post('packaging', [PackagingController::class,'store']);
Route::patch('packaging/{id}', [PackagingController::class,'update']);
Route::delete('packaging/{id}', [PackagingController::class,'destroy']);
