<?php

namespace App\Services;

use App\Repositories\UrlRepositoryInterface;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Events\UrlVisited;
use Carbon\Carbon;

class UrlService {

    private UrlRepositoryInterface $urlRepository;

    public function __construct(UrlRepositoryInterface $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function shortener($originalUrl)
    {
        do {
        $shortCode = Str::random(9);
        } while ($this->urlRepository->shortCodeExists($shortCode));

        Redis::setex($shortCode, 84600, $originalUrl);

        $data = [
            'original_url' => $originalUrl,
            'short_code' => $shortCode,
            'clicks' => 0,
            'created_at' => now(),
            'expire_at' => Carbon::now()->addDay(1),
        ];

        return $this->urlRepository->shortener($data);
    }

    public function redirect($short_code)
    {
        $originalUrl = Redis::get($short_code);

        if (!$originalUrl) {
            $url = $this->urlRepository->redirect($short_code);
            if (!$url) {
                abort(404, 'Short URL not found');
            }
            $originalUrl = $url->original_url;
        }

        Redis::setex($short_code, 84600, $originalUrl);
        Redis::incr("clicks:{$short_code}");

        return $originalUrl;
    }

    public function stats($short_code)
    {
        $url = $this->urlRepository->stats($short_code);
        $stats = [
            'original_url' => $url->original_url,
            'short_code' => $url->short_code,
            'clicks' => $url->clicks,
            'created_at' => $url->created_at,
        ];

        return $stats;
    }
}