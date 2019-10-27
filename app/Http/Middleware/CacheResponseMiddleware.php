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
        $cached_response= Cache::get($this->getKey($request));
        if($cached_response!=''){
            return response()->json(json_decode($cached_response));
        }
        else{
            return $next($request);
        }

    }

    public function terminate($request, $response){
        logger("termianting");
        logger($this->getkey($request));
        Cache::add($this->getKey($request), $response->getContent(), 30*60);
    }

    /**
     * @return mixed
     */
    private function getKey($request)
    {
        return $request->fullUrl();
    }

}
