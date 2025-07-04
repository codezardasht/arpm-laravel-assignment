<?php

use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::get('/office-employees', [OfficeController::class, 'index']);
