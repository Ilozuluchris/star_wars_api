<?php

namespace  App\Services;
use App\Exceptions\SwApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

abstract  class BaseService{
    public function __construct(Client $HttpClient)
    {
        $this->http_client = $HttpClient;
    }

    public function getUrl($url){
        try{
            $res = $this->http_client->get($url);
        }
        catch (RequestException $e){
            #todo log actual error
            throw  new SwApiException('Error getting list of films from swapi.com');
        }
        $contents = $res->getBody()->getContents();
        return $contents;
    }
}
