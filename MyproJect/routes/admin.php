<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Route::get('login', [AuthController::class, 'getLogin'])->name('admin.login');
// Route::post('login', [AuthController::class, 'postLogin'])->name('admin.login.handle');
// Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');

Route::group(['middleware' => ['check_login_admin'] , 'as' => 'admin.'], function () {
	// echo 'helloooo admin';exit;

    Route::get('login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('login.handle');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
	
	// Admin Dashboard
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard');	

	Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

	Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('/list', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/show/{id}', [PostController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('destroy');
    });
});