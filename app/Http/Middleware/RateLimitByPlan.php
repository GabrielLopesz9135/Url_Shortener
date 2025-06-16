<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redis;

class RateLimitByPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->attributes->get('authenticated_user');
        $apiKey = $user->api_key;
        $limit = $user->plan->daily_limit;

        // Se for ilimitado, permite sem limites
        if ($limit === -1) {
            return $next($request);
        }

        // Gera a chave Redis: rate_limit:{api_key}:{data_yyyy-mm-dd}
        $date = now()->toDateString();
        $key = "rate_limit:{$apiKey}:{$date}";

       // Verifica se já existe a chave no Redis
        if (!Redis::exists($key)) {
            Redis::setex($key, 86400, $limit);
        }

        $remaining = Redis::decr($key);

        // Verifica se passou do limite
        if ($remaining < 0) {
            return response()->json([
                'error' => 'Daily request limit exceeded.',
                'limit' => $limit,
                'remaining' => 0,
            ], 429);
        }

        return $next($request);
    }
}
