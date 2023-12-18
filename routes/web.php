<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\HomePageController;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\RegisterController;
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
    Route::get('/user/login',[LoginController::class,'index'])->name('login');
    Route::post('/user/login',[LoginController::class,'store']);
    Route::get('/user/logout',[LoginController::class,'logout']);

    Route::get('/user/register',[RegisterController::class,'register']);
    Route::post('/user/register',[RegisterController::class,'store']);

});
