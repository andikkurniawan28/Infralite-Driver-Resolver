<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DriverController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', WelcomeController::class)->name('welcome')->middleware(['auth']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'process'])->name('login_process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::resource('user', UserController::class)->middleware(['auth']);
Route::resource('device', DeviceController::class)->middleware(['auth']);
Route::resource('brand', BrandController::class)->middleware(['auth']);
Route::resource('driver', DriverController::class)->middleware(['auth']);
