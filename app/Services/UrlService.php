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
        $shortCode = Str::random(6);
        } while ($this->urlRepository->shortCodeExists($shortCode));

        Redis::setex($shortCode, 84600, $originalUrl);

        $data = [
            'original_url' => $originalUrl,
            'short_code' => $shortCode,
            'clicks' => 0,
            'created_at' => now(),
            'expire_at' => Carbon::now()->addDay(7),
        ];
        
        return $this->urlRepository->shortener($data);
    }

    public function redirect($short_code)
    {
        $originalUrl = Redis::get($short_code);

        if (!$originalUrl) {
            $url = $this->urlRepository->redirect($short_code);
            if ($url) {
                $originalUrl = $url->original_url;
                Redis::setex($short_code, 84600, $originalUrl);
                Redis::incr("clicks:{$short_code}");
            }else{
                $originalUrl = null;
            }
        }

        return $originalUrl;
    }

    public function stats($short_code)
    {
        $stats = $this->urlRepository->stats($short_code);

        if($stats){
            $stats = [
                'original_url' => $stats->original_url,
                'short_code' => $stats->short_code,
                'clicks' => $stats->clicks,
                'created_at' => $stats->created_at,
                'expire_at' => $stats->expire_at,
            ];
        }
        
        return $stats;
    }

    public function returnRateLimity($api_key)
    {
        $date = now()->toDateString();
        $key = "rate_limit:{$api_key}:{$date}";

        $remainingRequests = Redis::get($key);
        return $remainingRequests;
    }
}