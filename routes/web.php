<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'handleLogin'])->name('login');


Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class,  'logout'])->name('logout');
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Route::post('users', [UserController::class, 'store'])->name('users.store');
    // Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('users', UserController::class);


    Route::prefix('master-data')->as('master-data.')->group(function () {
        Route::prefix('category')->as('category.')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });

        Route::prefix('product')->as('product.')->controller(ProductController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });
    });
});
