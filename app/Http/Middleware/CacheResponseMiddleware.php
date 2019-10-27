<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class CacheResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #
        $key = $request->fullUrl();
        logger("about to cache");
        logger($key);
        return response()->json(Cache::remember($key, 300,
                    function()use ($next,$request){
                    $response = $next($request);
                    return json_decode($response->getContent());
                })
            );
    }
}
