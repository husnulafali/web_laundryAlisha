<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Backend\customerController;
use App\Http\Controllers\Backend\packetController;
use App\Http\Controllers\Backend\promoController;
use App\Http\Controllers\Backend\orderController;
use App\Http\Controllers\Backend\waController;
use App\Http\Controllers\Backend\userController;
use App\Http\Middleware\CheckRole;

// Rute untuk autentikasi
Route::get('login', [userController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [userController::class, 'login'])->name('login');
Route::post('logout', [userController::class, 'logout'])->name('logout');

// Rute dashboard hanya untuk pengguna yang terautentikasi
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/view', [dashboardController::class, 'index'])->name('dashboard.index');
});

// Grup rute untuk pengguna dengan peran 'owner'
Route::middleware(['auth', 'role:owner'])->group(function () {
    // Rute-rute untuk manajemen user
    Route::prefix('user')->group(function () {
        Route::get('/view', [userController::class, 'index'])->name('user.index');
        Route::get('/add', [userController::class, 'add'])->name('user.add');
        Route::post('/store', [userController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [userController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [userController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [userController::class, 'delete'])->name('user.delete');
    });

    // Rute-rute untuk manajemen customer, packet, promo, order, dan wa
    Route::prefix('customer')->group(function () {
        Route::get('/view', [customerController::class, 'index'])->name('customer.index');
        Route::get('/add', [customerController::class, 'add'])->name('customer.add');
        Route::post('/store', [customerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{cd_customer}', [customerController::class, 'edit'])->name('customer.edit');
        Route::post('/update/{cd_customer}', [customerController::class, 'update'])->name('customer.update');
        Route::get('/delete/{cd_customer}', [customerController::class, 'delete'])->name('customer.delete');
    });

    Route::prefix('packet')->group(function () {
        Route::get('/view', [packetController::class, 'index'])->name('packet.index');
        Route::get('/add', [packetController::class, 'add'])->name('packet.add');
        Route::post('/store', [packetController::class, 'store'])->name('packet.store');
        Route::get('/edit/{cd_packet}', [packetController::class, 'edit'])->name('packet.edit');
        Route::post('/update/{cd_packet}', [packetController::class, 'update'])->name('packet.update');
        Route::get('/delete/{cd_packet}', [packetController::class, 'delete'])->name('packet.delete');
    });

    Route::prefix('promo')->group(function () {
        Route::get('/view', [promoController::class, 'index'])->name('promo.index');
        Route::get('/add', [promoController::class, 'add'])->name('promo.add');
        Route::post('/store', [promoController::class, 'store'])->name('promo.store');
        Route::get('/edit/{id}', [promoController::class, 'edit'])->name('promo.edit');
        Route::post('/update/{id}', [promoController::class, 'update'])->name('promo.update');
        Route::get('/delete/{id}', [promoController::class, 'delete'])->name('promo.delete');
    });

    Route::prefix('order')->group(function () {
        Route::get('/view', [orderController::class, 'index'])->name('order.index');
        Route::get('/add', [orderController::class, 'add'])->name('order.add');
        Route::post('/store', [orderController::class, 'store'])->name('order.store');
        Route::get('/edit/{cd_orders}', [orderController::class, 'edit'])->name('order.edit');
        Route::post('/update/{cd_orders}', [orderController::class, 'update'])->name('order.update');
        Route::post('/order/update-statusLaundry/{cd_orders}', [orderController::class, 'updateLaundryStatus'])->name('order.updateLaundryStatus');
    });

    Route::prefix('wa')->group(function () {
        Route::get('/devices', [waController::class, 'getDevices'])->name('devices.index');
        Route::get('/qr-code/{deviceToken}', [waController::class, 'getQrCode'])->name('qr-code');
        Route::post('/disconnect/{deviceToken}', [waController::class, 'disconnectDevice'])->name('devices.disconnect');
    });
});

// Grup rute untuk pengguna dengan peran 'pegawai'
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    // Rute-rute untuk manajemen customer dan order saja
    Route::prefix('customer')->group(function () {
        Route::get('/view', [customerController::class, 'index'])->name('customer.index');
        Route::get('/add', [customerController::class, 'add'])->name('customer.add');
        Route::post('/store', [customerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{cd_customer}', [customerController::class, 'edit'])->name('customer.edit');
        Route::post('/update/{cd_customer}', [customerController::class, 'update'])->name('customer.update');
        Route::get('/delete/{cd_customer}', [customerController::class, 'delete'])->name('customer.delete');
    });

    Route::prefix('order')->group(function () {
        Route::get('/view', [orderController::class, 'index'])->name('order.index');
        Route::get('/add', [orderController::class, 'add'])->name('order.add');
        Route::post('/store', [orderController::class, 'store'])->name('order.store');
        Route::get('/edit/{cd_orders}', [orderController::class, 'edit'])->name('order.edit');
        Route::post('/update/{cd_orders}', [orderController::class, 'update'])->name('order.update');
        Route::post('/order/update-statusLaundry/{cd_orders}', [orderController::class, 'updateLaundryStatus'])->name('order.updateLaundryStatus');
    });
});
