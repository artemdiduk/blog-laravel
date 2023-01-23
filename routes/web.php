<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisrationController;
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


Route::get('/', [IndexController::class, 'show'])->name('index');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'show'])->name('index.admin');
});

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::get('registration', [RegisrationController::class, 'show'])->name('registration');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('register', [RegisrationController::class, 'register'])->name('register');
