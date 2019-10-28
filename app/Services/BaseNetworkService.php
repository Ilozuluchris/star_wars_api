<?php

namespace  App\Services;
use App\Exceptions\SwapiGetException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

abstract  class BaseNetworkService{
    use CacheService;

    public function __construct(Client $HttpClient)
    {
        $this->http_client = $HttpClient;
    }



    private function fetchFromSwapi($url):array{
        try{
            $res = $this->http_client->get($url);
        }
        catch (RequestException $e){
            #todo log actual error, maybe even pass normal error in
            throw  new SwapiGetException("Query on ".$url." failed. Reason ".$e->getMessage());
        }
        $contents = json_decode($res->getBody()->getContents(), true);
        $this->addToCache($url, $contents);
        return $contents;
    }

    public function getUrl(string $url):array{

        $contents = $this->getFromCache($url)??$this->fetchFromSwapi($url);
        return $contents;
    }
}
