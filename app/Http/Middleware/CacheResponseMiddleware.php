<?php

namespace App\Http\Middleware;

use App\Services\CacheService;
use Closure;
use Illuminate\Support\Facades\Cache;
use function PHPSTORM_META\type;

class CacheResponseMiddleware
{
    use CacheService;
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
        $this->addToCache($this->getCacheKey($request), $response->getContent(), 30);
    }

    /**
     * @return mixed
     */
    private function getCacheKey($request)
    {
        return $request->fullUrl();
    }

}
