<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProductController;

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
Route::get('/login',[AdminAuthController::class,'getLogin'])->name('getLogin');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
Route::get('/product',[AdminProductController::class,'getProduct'])->name('getProduct');
