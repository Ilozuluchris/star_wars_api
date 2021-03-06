<?php

namespace App\Http\Middleware;

use App\Services\CacheResponseService;
use Closure;

class CacheResponseMiddleware
{
    use CacheResponseService;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        #todo add status code
        $res = $this->getFromCache($this->getCacheKey($request),$next($request));
        if (is_string($res)){
            return response()->json(json_decode($res));
        }
        return $res;
    }

    public function terminate($request, $response){
            $this->addToCache($this->getCacheKey($request), $response->getContent(),$response->status(), 30);
    }

    /**
     * @return mixed
     */
    private function getCacheKey($request)
    {
        return $request->fullUrl();
    }

}
