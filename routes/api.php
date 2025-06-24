<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UrlController;
use App\Http\Controllers\BenchmarkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['apiValidate'])->group(function () {
    Route::post('/url', [UrlController::class, 'shortener']);
    Route::get('/stats/{short_code}', [UrlController::class, 'stats']);
});

Route::post('/send-email-verify', [VerifyEmailController::class, 'sendEmail'])->name('user.email.verify');
Route::post('/send-password-reset', [PasswordController::class, 'sendEmail'])->name('user.password.reset');

/* Route::get('/redisBenchmark/{shortCode}', [BenchmarkController::class, 'redisBenchmark'])->name('urls.redisBenchmark');
Route::get('/directBenchmark/{shortCode}', [BenchmarkController::class, 'directBenchmark'])->name('urls.directBenchmark'); */