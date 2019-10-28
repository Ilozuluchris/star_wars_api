<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/*** Use this to cache response
 * Trait CacheService
 * @package App\Services
 */
trait CacheResponseService{

    /** Get content from cache
     * @param string $key Key used to get content from cache
     * @param mixed|null $default_return
     * @return mixed|null
     */
    public function getFromCache($key, $default_return=null){
        $cached_response= Cache::get($key);
        return (bool)$cached_response ? $cached_response : $default_return;
    }

    /** Add response to cache. Does not cache response with HTTP 4XX AND 5XX codes
     * @param string $key
     * @param string $data Data to cache
     * @param string $status HTTP status code
     * @param int $ttl time to live in cache
     */
    public function  addToCache(string $key,  $data,string $status, $ttl=10*60){
        if(!(Str::startsWith($status, '5')||Str::startsWith($status, '4'))){
            Cache::add($key,$data,$ttl);
        }
    }
}