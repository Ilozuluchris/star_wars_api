<?php

namespace  App\Services;
use App\Exceptions\SwApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

abstract  class BaseNetworkService{
    public function __construct(Client $HttpClient)
    {
        $this->http_client = $HttpClient;
    }

    public function getUrl(string $url):array{
        try{
            $res = $this->http_client->get($url);
        }
        catch (RequestException $e){
            #todo log actual error, maybe even pass normal error in
            throw  new SwApiException('Error getting list of films from swapi.com');
        }
        $contents = json_decode($res->getBody()->getContents(), true);
        return $contents;
    }
}
