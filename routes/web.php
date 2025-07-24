<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'handleLogin'])->name('login');


Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class,  'logout'])->name('logout');
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});
