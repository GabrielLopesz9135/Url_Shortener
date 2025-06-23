<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UrlController extends Controller
{
    private $service;

    public function __construct(UrlService $service)
    {
        $this->service = $service;
    }

    public function shortener(Request $request)
    {
        $api_key = $request->attributes->get('authenticated_user')->api_key;
        $RateLimitRemainingDay = $this->service->returnRateLimity($api_key);

        try {
            $request->validate([
                'original_url' => 'required',
            ]);

            $shortCode = $this->service->shortener($request->input('original_url'));

            return response()->json([
                'status' => 200,
                'data' => ['short_url' => url("short/$shortCode")],
                'message' => 'URL encurtada com sucesso',
                'RateLimit-Remaining-Day' => $RateLimitRemainingDay,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => ['short_url' => null],
                'message' => 'Erro ao encurtar URL!',
                'RateLimit-Remaining-Day' => $RateLimitRemainingDay,
            ])->setStatusCode(500);
        }
    }

    public function redirect($short_code)
    {
        $originalUrl = $this->service->redirect($short_code);
        if(!$originalUrl) {
            return response()->json([
                'status' => 404,
                'data' => [
                    'url' => null
                ],
                'message' => 'URL não encontrada',
            ], 404);
        }

        if (!preg_match('#^https?://#', $originalUrl)) {
            $originalUrl = 'http://' . $originalUrl;
        }
        
        return redirect()->away($originalUrl);
    }

    public function stats(Request $request, $short_code)
    {
        $api_key = $request->attributes->get('authenticated_user')->api_key;
        $RateLimitRemainingDay = $this->service->returnRateLimity($api_key);

        $stats = $this->service->stats($short_code);

        if(!$stats) {
            return response()->json([
                'status' => 404,
                'data' => [
                    'url' => null
                ],
                'message' => 'URL não encontrada',
                'RateLimit-Remaining-Day' => $RateLimitRemainingDay,
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => [
                'url' => $stats
            ],
            'message' => 'Estatísticas recuperadas com sucesso',
            'RateLimit-Remaining-Day' => $RateLimitRemainingDay
        ], 200);
    }

}
