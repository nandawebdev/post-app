<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
	return view('auth.login');
});

Route::post('login', [LoginController::class, 'handleLogin'])->name('login');

Route::middleware('auth')->group(function () {
	Route::post('logout', [LoginController::class,  'logout'])->name('logout');
	Route::get('dashboard', DashboardController::class)->name('dashboard');

	Route::prefix('get-data')->as('get-data.')->group(function () {
		Route::get('/products', [ProductController::class, 'getData'])->name('products');
		Route::get('/product-stock', [ProductController::class, 'checkStock'])->name('product-stock');
	});


	Route::resource('users', UserController::class);
	Route::post('users/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
	Route::post('users/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

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

	Route::prefix('penerimaan-barang')->as('penerimaan-barang.')->controller(PenerimaanBarangController::class)->group(function () {
		Route::get('/', 'index')->name('index');
		Route::post('/', 'store')->name('store');
		Route::delete('/{id}/destroy', 'destroy')->name('destroy');
	});

	Route::prefix('laporan')->as('laporan.')->group(function () {
		Route::prefix('penerimaan-barang')->as('penerimaan-barang.')->controller(PenerimaanBarangController::class)->group(function () {
			Route::get('/laporan', 'laporan')->name('laporan');
			Route::get('/laporan/{nomor_penerimaan}/detail', 'detailLaporan')->name('detail-laporan');
		});
	});
});
