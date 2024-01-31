<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('generate.barcode');

Route::get('/generate-qr-code', [ProductController::class, 'index']);
Route::post('/generate-qr-code', [ProductController::class, 'generateQRCode'])->name('generateQRCode');

