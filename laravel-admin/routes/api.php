<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\OrderController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::post('user/info', [AuthController::class, 'updateInfo']);
    Route::post('user/password', [AuthController::class, 'updatePassword']);

    //Route::get('users', [UserController::class, 'index']);
    //Route::post('users', [UserController::class, 'store']);
    //Route::get('users/{id}', [UserController::class, 'show']);
    //Route::put('users/{id}', [UserController::class, 'update']);
    //Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('products', ProductController::class);    
    Route::get('permissions', [PermissionController::class, 'index']);    
    Route::post('upload', [ImageUploadController::class, 'upload']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::apiResource('orders', OrderController::class)->only('index', 'show');
});
