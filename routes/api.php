<?php

use App\Http\Controllers\Api\AdminBillApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#bill
Route::put('/admin/bill/{id}', [AdminBillApi::class, 'update']);

#product
Route::put('/admin/product/status/{productCode}', [\App\Http\Controllers\Api\AdminProductApi::class, 'updateStatus']);
Route::put('/admin/product/status', [\App\Http\Controllers\Api\AdminProductApi::class, 'controlStatus']);


