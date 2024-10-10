<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminPackagingController;
use App\Http\Controllers\Admin\AdminCompanyController;

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

//AUTH
Route::get('/login',[AdminAuthController::class,'getLogin'])->name('getLogin');

//DASHBOARD
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

//COMPANY
Route::get('/company', [AdminCompanyController::class, 'getCompany'])->name('getCompany');
Route::get('/company/create', [AdminCompanyController::class, 'addCompany'])->name('addCompany');
Route::post('/company/create', [AdminCompanyController::class, 'storeCompany'])->name('storeCompany');
Route::get('/company/update/{id}', [AdminCompanyController::class, 'editCompany'])->name('editCompany');
Route::put('/company/update/{id}', [AdminCompanyController::class, 'updateCompany'])->name('updateCompany');
Route::delete('/company/destroy/{id}', [AdminCompanyController::class, 'destroyCompany'])->name('destroyCompany');

//USER
Route::get('/user', [AdminAuthController::class, 'getUser'])->name('getUser');
Route::get('/user/create', [AdminAuthController::class, 'addUser'])->name('addUser');
Route::post('/user/create', [AdminAuthController::class, 'storeUser'])->name('storeUser');
Route::get('/user/update/{id}', [AdminAuthController::class, 'editUser'])->name('editUser');
Route::put('/user/update/{id}', [AdminAuthController::class, 'updateUser'])->name('updateUser');
Route::delete('/user/destroy/{id}', [AdminAuthController::class, 'destroyUser'])->name('destroyUser');

//PACKAGING
Route::get('/packaging', [AdminPackagingController::class, 'getPackaging'])->name('getPackaging');
Route::get('/packaging/create', [AdminPackagingController::class, 'addPackaging'])->name('addPackaging');
Route::post('/packaging/create', [AdminPackagingController::class, 'storePackaging'])->name('storePackaging');
Route::get('/packaging/update/{id}', [AdminPackagingController::class, 'editPackaging'])->name('editPackaging');
Route::put('/packaging/update/{id}', [AdminPackagingController::class, 'updatePackaging'])->name('updatePackaging');
Route::delete('/packaging/destroy/{id}', [AdminPackagingController::class, 'destroyPackaging'])->name('destroyPackaging');

//PRODUCT
Route::get('/product', [AdminProductController::class, 'getProduct'])->name('getProduct');
Route::get('/product/create', [AdminProductController::class, 'addProduct'])->name('addProduct');
Route::post('/product/create', [AdminProductController::class, 'storeProduct'])->name('storeProduct');
Route::get('/product/update/{id}', [AdminProductController::class, 'editProduct'])->name('editProduct');
Route::put('/product/update/{id}', [AdminProductController::class, 'updateProduct'])->name('updateProduct');
Route::delete('/product/destroy/{id}', [AdminProductController::class, 'destroyProduct'])->name('destroyProduct');

