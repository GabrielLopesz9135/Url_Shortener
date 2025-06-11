<?php

use App\Http\Controllers\BenchmarkController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

/* Route::get('/', [UrlController::class, 'index'])->name('urls.home'); */

Route::get('/', function () {
    return view('urls.home');
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