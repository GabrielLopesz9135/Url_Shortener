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
        $request->validate([
            'original_url' => 'required',
        ]);

        $originalUrl = $request->input('original_url');
        $shortCode = $this->service->shortener($originalUrl);

        return response()->json([
           'short_url' => url("/$shortCode"),
        ]);
    }

    public function redirect($short_code)
    {
        $originalUrl = $this->service->redirect($short_code);
        return redirect()->to($originalUrl);
    }

    public function stats($short_code)
    {
        $data = $this->service->stats($short_code);
        return response()->json($data);
    }

}
