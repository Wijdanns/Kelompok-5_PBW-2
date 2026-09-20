<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;

// Rute untuk menampilkan halaman awal
Route::get('/', [ShippingController::class, 'index'])->name('shipping.index');

// Rute untuk menangani proses kalkulasi (submit form)
Route::post('/', [ShippingController::class, 'calculate'])->name('shipping.calculate');
