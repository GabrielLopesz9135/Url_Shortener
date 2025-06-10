<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('urls')->group(function () {
    Route::get('/', [UrlController::class, 'index'])->name('urls.index');
    Route::middleware('throttle:10,1')->post('/', [UrlController::class, 'shortener'])->name('urls.shortener');
    Route::get('/stats/{short_code}', [UrlController::class, 'stats'])->name('urls.stats');
});

Route::get('/{shortCode}', [UrlController::class, 'redirect'])->name('urls.redirect');


