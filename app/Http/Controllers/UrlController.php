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
        try {
            $request->validate([
                'original_url' => 'required',
            ]);

            $shortCode = $this->service->shortener($request->input('original_url'));

            return response()->json([
                'status' => 200,
                'data' => ['short_url' => url("short/$shortCode")],
                'message' => 'URL encurtada com sucesso',
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'data' => ['short_url' => null],
                'message' => 'Erro ao encurtar URL!',
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

    public function stats($short_code)
    {
        $stats = $this->service->stats($short_code);

        if(!$stats) {
            return response()->json([
                'status' => 404,
                'data' => [
                    'url' => null
                ],
                'message' => 'URL não encontrada',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => ['url' => $stats],
            'message' => 'Estatísticas recuperadas com sucesso',
        ], 200);
    }

}
