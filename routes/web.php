<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\userController;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Backend\customerController;
use App\Http\Controllers\Backend\packetController;
use App\Http\Controllers\Backend\orderController;
use App\Http\Controllers\Backend\waController;
use App\Http\Controllers\Backend\reportController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Middleware\CheckRole;





Route::get('/', [userController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [userController::class, 'login'])->name('login');
Route::post('/logout', [userController::class, 'logout'])->name('logout');

Route::get('reset/password', [PasswordResetController::class, 'showResetForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/update', [PasswordResetController::class, 'resetPassword'])->name('password.update');



Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('view', [dashboardController::class, 'index'])->name('dashboard.index');
    });
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/view/owner', [userController::class, 'index'])->name('user.index');
        Route::get('/add', [userController::class, 'add'])->name('user.add');
        Route::post('/store', [userController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [userController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [userController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [userController::class, 'delete'])->name('user.delete');
    });
    Route::prefix('customer')->group(function () {
        Route::get('/view/owner', [customerController::class, 'index'])->name('customer.owner.index');
    
    });

    Route::prefix('packet')->group(function () {
        Route::get('/view/owner', [packetController::class, 'index'])->name('packet.index');
        Route::get('/add', [packetController::class, 'add'])->name('packet.add');
        Route::post('/store', [packetController::class, 'store'])->name('packet.store');
        Route::get('/edit/{cd_packet}', [packetController::class, 'edit'])->name('packet.edit');
        Route::post('/update/{cd_packet}', [packetController::class, 'update'])->name('packet.update');
        Route::get('/delete/{cd_packet}', [packetController::class, 'delete'])->name('packet.delete');
    });

    Route::prefix('order')->group(function () {
        Route::get('/view/owner', [orderController::class, 'index'])->name('order.owner.index');
    });

    Route::prefix('report')->group(function () {
        Route::get('/view/owner', [reportController::class, 'index'])->name('report.index');
        Route::get('/show', [reportController::class, 'show'])->name('report.show');
  
    });

    Route::prefix('wa')->group(function () {
        Route::get('/devices/owner', [waController::class, 'getDevices'])->name('devices.owner.index');
        Route::get('/qr-code/{deviceToken}', [waController::class, 'getQrCode'])->name('qr-code');
        // Route::post('/disconnect/{deviceToken}', [waController::class, 'disconnectDevice'])->name('devices.disconnect');
    });

});


Route::middleware(['auth', 'role:pegawai'])->group(function () {

    Route::prefix('packet')->group(function () {
        Route::get('/view/pegawai', [packetController::class, 'index'])->name('packet.pegawai.index');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/view/pegawai', [customerController::class, 'index'])->name('customer.index');
        Route::get('/add', [customerController::class, 'add'])->name('customer.add');
        Route::post('/store', [customerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{cd_customer}', [customerController::class, 'edit'])->name('customer.edit');
        Route::post('/update/{cd_customer}', [customerController::class, 'update'])->name('customer.update');
        Route::get('/delete/{cd_customer}', [customerController::class, 'delete'])->name('customer.delete');
    });

    Route::prefix('order')->group(function () {
        Route::get('/view/pegawai', [orderController::class, 'index'])->name('order.index');
        Route::get('/add', [orderController::class, 'add'])->name('order.add');
        Route::post('/store', [orderController::class, 'store'])->name('order.store');
        Route::get('/edit/{cd_orders}', [orderController::class, 'edit'])->name('order.edit');
        Route::get('/print/{cd_orders}', [orderController::class, 'print'])->name('order.print');
        Route::post('/update/{cd_orders}', [orderController::class, 'update'])->name('order.update');
        Route::post('/order/update-statusLaundry/{cd_orders}', [orderController::class, 'updateLaundryStatus'])->name('order.updateLaundryStatus');
        Route::get('/order/updateMessage', [orderController::class, 'editMessage'])->name('order.updateMessage');
        Route::post('/order/updateMessage', [orderController::class, 'updateMessage'])->name('order.updateMessage.update');
        Route::post('/webhook/message-status', [orderController::class, 'handleMessageStatusUpdate']);

    });

        
    Route::prefix('wa')->group(function () {
        Route::get('/devices/pegawai', [waController::class, 'getDevices'])->name('devices.pegawai.index');
    });

});

