<?php

use App\Http\Controllers\admin\bill\AdminBillController;
use App\Http\Controllers\bill\BillController;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\PasswordController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\user\HomePageController;
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

#route client
Route::prefix('/')->group(function () {
    #Home product
    Route::get('', [HomePageController::class, 'index'])->name("home");

    #Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/register', [RegisterController::class, 'register']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/forgot', [PasswordController::class, 'forgot']);
    Route::post('/forgot', [PasswordController::class, 'resetPass']);



    Route::middleware('auth')->group(function () {
        #Products
        Route::get('/products/{code}', [ProductController::class, 'show']);

        #Bill
        Route::post('/payment/{bill_code}', [BillController::class, 'store']);
        Route::get('/payment/{bill_code}', [BillController::class, 'index'])->name('show_bill');
        Route::get('/bills/history', [BillController::class, 'history'])->name('history');

        Route::get('/bills/history/confirm/{bill_code}', [BillController::class, 'historyConfirm']);

        Route::get('/payment/confirm/{bill_code}', [BillController::class, 'confirmPay']);

        Route::get('/change-password', [PasswordController::class, 'index']);
        Route::post('/change-password', [PasswordController::class, 'store']);

    });

    #CATEGORY
    Route::get('/category/{code}', [HomePageController::class, 'category']);

});
Route::middleware(['auth', 'role'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/bill', [AdminBillController::class, 'index']);
        Route::get('/bill-ajax', [AdminBillController::class, 'index']);
    });
});

