<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\HomePageController;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\product\ProductController;
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
Route::prefix('/')->group(function(){
    #Home product
    Route::get('',[HomePageController::class,'index'])->name("home");

    #Login
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'store']);
    Route::get('/logout',[LoginController::class,'logout']);

    Route::get('/register',[RegisterController::class,'register']);
    Route::post('/register',[RegisterController::class,'store']);

    #Products
    Route::get('/products',[ProductController::class,'index']);
});
