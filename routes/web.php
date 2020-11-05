<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DeviceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

Route::name('user.')->prefix('user')->group(function () {
    Route::get('{id}', [UserController::class, 'view'])->name('view');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/', [UserController::class, 'list'])->name('list');
    Route::delete('{id}', [UserController::class, 'delete'])->name('delete');
});
Route::name('device.')->prefix('device')->group(function () {
    Route::get('{id}', [DeviceController::class, 'view'])->name('view');
    Route::post('/', [DeviceController::class, 'store'])->name('store');
    Route::get('/', [DeviceController::class, 'list'])->name('list');
    Route::delete('{id}', [DeviceController::class, 'delete'])->name('delete');
});
