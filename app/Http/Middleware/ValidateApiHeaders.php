<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ValidateApiHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');
        $contentType = $request->header('Content-Type');

         // Verifica se Content-Type é application/json
        if (strtolower($contentType) !== 'application/json') {
            return response()->json([
                'error' => 'Content-Type must be application/json'
            ], 400);
        }

        // Verifica se Authorization está no formato "Bearer XXXXX"
        if (!$authHeader || !preg_match('/^Bearer\s[\w]+$/', $authHeader, $matches)) {
            return response()->json([
                'error' => 'Missing or invalid Authorization header'
            ], 401);
        }

        $apiKey = explode(" ",$matches[0]);

        // Busca o usuário pela API Key
        $user = User::where('api_key', $apiKey[1])->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }
        $request->attributes->set('authenticated_user', $user);

        return $next($request);
    }
}
