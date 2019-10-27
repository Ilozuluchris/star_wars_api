<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

trait CacheService{

    public function getFromCache($key){
        $cached_response= Cache::get($key);
        if($cached_response!=''){
            return $cached_response;
        }
        return null;
    }

    public function  addToCache(string $key, array $data){
        Cache::add($key,$data,10*60 );
    }
}