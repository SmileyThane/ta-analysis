<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('home');
Route::post('/submit-request', [App\Http\Controllers\LandingController::class, 'submitRequest'])->name('submit.request');
Route::get('/payment-success', [App\Http\Controllers\LandingController::class, 'paymentSuccess'])->name('payment.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/upload-results', [App\Http\Controllers\DashboardController::class, 'uploadResults'])->name('upload.results');
    Route::get('/download/{id}', [App\Http\Controllers\DashboardController::class, 'downloadResult'])->name('download.result');
});

require __DIR__.'/auth.php';
