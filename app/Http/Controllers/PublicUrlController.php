<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PublicUrlService;

class PublicUrlController extends Controller
{
    private $service;

    public function __construct(PublicUrlService $service)
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

            return redirect()
            ->route('home')
            ->with([
                'status' => "Success",
                'data' => ['short_url' => url("url/$shortCode")],
                'message' => 'URL encurtada com sucesso',
            ]);
             
        } catch (\Exception $e) {
            return redirect()
            ->route('home')
            ->with([
                'status' => "Error",
                'data' => ['short_url' => null],
                'message' => 'Erro ao encurtar URL!',
            ]);
        }
    }

    public function redirect($short_code)
    {
        $originalUrl = $this->service->redirect($short_code);
        if(!$originalUrl) {
            return view('short-link-404');
        }

        if (!preg_match('#^https?://#', $originalUrl)) {
            $originalUrl = 'http://' . $originalUrl;
        }
        
        return redirect()->away($originalUrl);
    }

    public function stats(Request $request)
    {
        $url  = $request->input('url');
        $url = explode("url/", $url);
        $stats = $this->service->stats($url[1]);

        if(!$stats) {
            return redirect()
            ->route('url.clicks')
            ->with([
                'status' => "Error",
                'data' => [
                    'url' => null
                ],
                'message' => 'URL não encontrada',
            ]);
        }
        return redirect()
            ->route('url.clicks')
            ->with([
                'status' => "Success",
                'data' => $stats,
                'message' => 'Estatísticas recuperadas com sucesso'
            ]);
    }

}
