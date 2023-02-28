<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the maximum number of requests per minute from the config file
        $maxRequestsPerMinute = config('app.max_requests_per_minute');

        $ipAddress = $request->ip();
        $currentMinute = Carbon::now('UTC')->format('YmdHi');
        $cacheKey = "rate_limiter:{$ipAddress}:{$currentMinute}";
        $requestsMade = Cache::get($cacheKey, 0);
        if ($requestsMade >= $maxRequestsPerMinute) {
            return response('Too Many Requests', 429);
        }
        Cache::put($cacheKey, $requestsMade + 1, Carbon::now('UTC')->addMinute());
        return $next($request);
    }
}
