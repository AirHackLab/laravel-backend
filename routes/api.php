<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DeviceController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\MosquittoController;

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
Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('{id}', [UserController::class, 'view']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/', [UserController::class, 'list']);
        Route::delete('{id}', [UserController::class, 'delete']);
    });
    Route::prefix('device')->group(function () {
        Route::get('{id}', [DeviceController::class, 'view']);
        Route::post('/', [DeviceController::class, 'store']);
        Route::get('/', [DeviceController::class, 'list']);
        Route::delete('{id}', [DeviceController::class, 'delete']);
        Route::get('/export/mosquitto', [MosquittoController::class, 'list']);
    });
});

