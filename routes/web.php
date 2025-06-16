<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/urls', function () {
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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('pages.user.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
