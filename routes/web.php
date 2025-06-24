<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PublicUrlController;

Route::prefix('/')->group(function (){
    Route::get('/', function () {
        return view('pages.urls.home');
    })->name('home');

    Route::get('/api-docs', function () {
        return view('api-docs');
    })->name('api_docs');

    Route::get('/benchmark', function () {
        return view('benchmark');
    })->name('benchmark');

    Route::get('/technologies', function () {
        return view('technologies');
    })->name('technologies');

    Route::get('/clicks', function () {
        return view('pages.urls.click-counter');
    })->name('url.clicks');
});

Route::prefix('/url')->group(function (){
    Route::post('/', [PublicUrlController::class, 'shortener'])->name('urls.shortener');
    Route::get('/{shortCode}', [PublicUrlController::class, 'redirect'])->name('urls.redirect');
    Route::post('/stats', [PublicUrlController::class, 'stats'])->name('urls.stats');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('pages.user.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/enviar-email', [EmailController::class, 'enviarEmailDeTeste']);

require __DIR__.'/auth.php';
