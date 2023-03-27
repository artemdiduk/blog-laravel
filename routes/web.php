<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisrationController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
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
    Route::delete('/group/delate/{groupDelate}', [AdminController::class, 'delateGroup'])->name('group.delate');
    Route::get('/update/group/form/{groupUpdateForm}', [AdminController::class, 'updateGroupCreate'])->name('update.group.from');
    Route::post('/update/group/{groupUpdate}', [AdminController::class, 'updateGroup'])->name('update.group');
    Route::get('/users/', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/account/users/{user}', [AdminController::class, 'showUser'])->name('admin.account.users');
});

Route::group(['prefix' => 'group'], function () {
    Route::get('/{group}', [GroupController::class, 'show'])->name('group');
    Route::post('/create', [GroupController::class, 'create'])->name('group.create');
    Route::get('/{group}', [GroupController::class, 'show'])->name('group');
});

Route::group(['prefix' => 'article'], function () {
    Route::get('/update/form', [ArticleController::class, 'updateStore'])->name('article.update.form')->middleware('author');
    Route::post('/update/{post}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/delate', [ArticleController::class, 'delate'])->name('article.delate')->middleware('author');
    Route::get('/create/form', [ArticleController::class, 'read'])->name('article.create.form')->middleware('auth');
    Route::post('/create', [ArticleController::class, 'create'])->name('article.create');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::post('update/{user}', [UserController::class, 'update'])->name('user.update');
});

Route::get('{groupSlag}/{articleId}', [ArticleController::class, 'show'])->name('article');

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::get('registration', [RegisrationController::class, 'show'])->name('registration');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('register', [RegisrationController::class, 'register'])->name('register');
Route::get('account', [UserController::class, 'index'])->name('account')->middleware('auth');

