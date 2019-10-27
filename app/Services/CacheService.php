<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

trait CacheService{

    public function getFromCache($key, $default_return=null){
        $cached_response= Cache::get($key);
        if($cached_response!=''){
            return $cached_response;
        }
        return $default_return;
    }

    public function  addToCache(string $key,  $data){
        Cache::add($key,$data,10*60 );
    }
}