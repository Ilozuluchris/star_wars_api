<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait CacheService{

    public function getFromCache($key, $default_return=null){
        $cached_response= Cache::get($key);
        return (bool)$cached_response ? $cached_response : $default_return;
    }

    public function  addToCache(string $key,  $data,string $status, $ttl=10*60){
        if(!(Str::startsWith($status, '5')||Str::startsWith($status, '4'))){
            Cache::add($key,$data,$ttl);
        }
    }
}