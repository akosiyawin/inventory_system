<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Authentication check. Access this route /authenticated to see if user is authenticate*/

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return UserResource::make($request->user());
});


Route::prefix('user')->group(function () {
    Route::post('/register', [\App\Http\Controllers\UserAuthenticationController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\UserAuthenticationController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\UserAuthenticationController::class, 'logout']);
});

Route::prefix('category')->group(function () {
    Route::get('/',[\App\Http\Controllers\CategoryController::class,'index']);
    Route::post('/store',[\App\Http\Controllers\CategoryController::class,'store']);
    Route::delete('/{category}',[\App\Http\Controllers\CategoryController::class,'destroy']);
});

Route::prefix('product')->group(function () {
    Route::get('/',[\App\Http\Controllers\ProductController::class,'index']);
    Route::post('/store',[\App\Http\Controllers\ProductController::class,'store']);
    Route::patch('/increase/{product}',[\App\Http\Controllers\ProductController::class,'increase']);
    Route::patch('/decrease/{product}',[\App\Http\Controllers\ProductController::class,'decrease']);
    Route::patch('/{product}',[\App\Http\Controllers\ProductController::class,'update']);
    Route::delete('/{product}',[\App\Http\Controllers\ProductController::class,'destroy']);
    Route::get('/{product}',[\App\Http\Controllers\ProductController::class,'edit']);
    Route::get('/statistics/report',[\App\Http\Controllers\ProductController::class,'statistics']);
});
