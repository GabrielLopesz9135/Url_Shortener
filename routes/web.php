<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PublicUrlController;

/**
 * API - Documentação rápida das rotas expostas (implementação futura em /api)
 *
 * POST /url
 * - Descrição: Encurta uma URL.
 * - Headers (API): Authorization: Bearer <API_KEY>, Content-Type: application/json
 * - Body (JSON): { "original_url": "https://exemplo.com" }
 * - Response (200): { status:200, data: { short_url: "https://HOST/url/<shortCode>" }, message: string }
 * - Erros: 400 validação, 429 rate-limit, 500 erro interno
 *
 * GET /url/{shortCode}
 * - Descrição: Redireciona (302) para a URL original associada ao shortCode.
 * - Auth: pública (não requer API key)
 *
 * POST /url/stats
 * - Descrição: Recupera estatísticas para um short code (web form envia uma URL completa).
 * - Body (web): { "url": "https://HOST/url/<shortCode>" }
 * - Response (200): { status:200, data: { url: { original_url, short_code, clicks, created_at, expire_at } }, message }
 *
 * Observações para a API real (/api):
 * - Recomenda-se prefixar rotas com /api e aplicar middleware `ValidateApiHeaders` e `RateLimitByPlan`.
 * - Cache/contadores: Redis usado para cache de URL e chaves `clicks:{short_code}`. O job `SyncUrlClicks` consolida no MongoDB.
 */

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

Route::get('/404', function(){
    return view('short-link-404');
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
