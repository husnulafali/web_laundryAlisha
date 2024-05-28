<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\customerController;
use App\Http\Controllers\backend\packetController;
use App\Http\Controllers\backend\promoController;
use App\Http\Controllers\backend\orderController;
use App\Http\Controllers\backend\waController;


Route::get('/', function () {
    return view('layouts.dashboard');
});

Route::prefix('customer')->group(function(){
    Route::get('/view', [customerController::class, 'index'])->name('customer.index');
    Route::get('/add', [customerController::class, 'add'])->name('customer.add');
    Route::post('/store', [customerController::class, 'store'])->name('customer.store');
    Route::get('/edit/{cd_customer}', [customerController::class, 'edit'])->name('customer.edit');
    Route::post('/update/{cd_customer}', [customerController::class, 'update'])->name('customer.update');
    Route::get('/delete/{cd_customer}', [customerController::class, 'delete'])->name('customer.delete');
});
Route::prefix('packet')->group(function(){
    Route::get('/view', [packetController::class, 'index'])->name('packet.index');
    Route::get('/add', [packetController::class, 'add'])->name('packet.add');
    Route::post('/store', [packetController::class, 'store'])->name('packet.store');
    Route::get('/edit/{cd_packet}', [packetController::class, 'edit'])->name('packet.edit');
    Route::post('/update/{cd_packet}', [packetController::class, 'update'])->name('packet.update');
    Route::get('/delete/{cd_packet}', [packetController::class, 'delete'])->name('packet.delete');
});
Route::prefix('promo')->group(function(){
    Route::get('/view', [promoController::class, 'index'])->name('promo.index');
    Route::get('/add', [promoController::class, 'add'])->name('promo.add');
    Route::post('/store', [promoController::class, 'store'])->name('promo.store');
    Route::get('/edit/{id}', [promoController::class, 'edit'])->name('promo.edit');
    Route::post('/update/{id}', [promoController::class, 'update'])->name('promo.update');
    Route::get('/delete/{id}', [promoController::class, 'delete'])->name('promo.delete');
});
Route::prefix('order')->group(function(){
    Route::get('/view', [orderController::class, 'index'])->name('order.index');
    Route::get('/add', [orderController::class, 'add'])->name('order.add');
    Route::post('/store', [orderController::class, 'store'])->name('order.store');
    Route::get('/edit/{cd_orders}', [orderController::class, 'edit'])->name('order.edit');
    Route::post('/update/{cd_orders}', [orderController::class, 'update'])->name('order.update');
    Route::post('/order/update-statusLaundry/{cd_orders}',[orderController::class, 'updateLaundryStatus'])->name('order.updateLaundryStatus');
    Route::get('/cek-message/{messageId}', [orderController::class, 'cekMessage'])->name('cek.message');
});

Route::prefix('wa')->group(function(){
    Route::get('/devices', [WaController::class, 'getDevices'])->name('devices.index');
    Route::get('/qr-code/{deviceToken}', [WaController::class, 'getQrCode'])->name('qr-code');
    Route::post('/disconnect/{deviceToken}', [WaController::class, 'disconnectDevice'])->name('devices.disconnect');
});
