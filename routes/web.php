<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\customerController;



Route::get('/', function () {
    return view('layouts.dashboard');
});

Route::prefix('customer')->group(function(){
    Route::get('/view', [customerController::class, 'index'])->name('customer.index');
    Route::get('/add', [customerController::class, 'add'])->name('customer.add');

    });
    
