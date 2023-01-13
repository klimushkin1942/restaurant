<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryMenuController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DishController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\OrderItemController;

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

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('categories', CategoryMenuController::class);
    Route::resource('users', UserController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('order_items', OrderItemController::class);
});
