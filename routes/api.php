<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\BenchmarkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['api'])->group(function () {
    Route::post('/url', [UrlController::class, 'shortener'])->name('urls.shortener');
    Route::get('/stats/{short_code}', [UrlController::class, 'stats'])->name('urls.stats');
    Route::get('/{shortCode}', [UrlController::class, 'redirect'])->name('urls.redirect');
});



Route::get('/redisBenchmark/{shortCode}', [BenchmarkController::class, 'redisBenchmark'])->name('urls.redisBenchmark');
Route::get('/directBenchmark/{shortCode}', [BenchmarkController::class, 'directBenchmark'])->name('urls.directBenchmark');