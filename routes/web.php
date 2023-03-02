<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisrationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ArticleController;
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
Route::post('group/create', [GroupController::class, 'create'])->name('group.create');
Route::get('article/create/form', [ArticleController::class, 'read'])->name('article.create.form')->middleware('auth');
Route::post('article/create', [ArticleController::class, 'create'])->name('article.create');
Route::get('group/{group}', [GroupController::class, 'show'])->name('group');
Route::get('{groupSlag}/{articleName}', [ArticleController::class, 'show'])->name('article');
Route::get('article/update/form', [ArticleController::class, 'updateStore'])->name('article.update.form');
Route::post('article/update', [ArticleController::class, 'update'])->name('article.update')->middleware('author');
Route::post('article/delate', [ArticleController::class, 'delate'])->name('article.delate')->middleware('author');
