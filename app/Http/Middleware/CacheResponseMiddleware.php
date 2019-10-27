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
    public function handle($request, Closure $next){
        #todo add status code
        $cached_response= Cache::get($this->getCacheKey($request));
        if($cached_response!=''){
            return response()->json(json_decode($cached_response));
        }
        else{
            return $next($request);
        }

    }

    public function terminate($request, $response){
        Cache::add($this->getCacheKey($request), $response->getContent(), 20);
    }

    /**
     * @return mixed
     */
    private function getCacheKey($request)
    {
        return $request->fullUrl();
    }

}
