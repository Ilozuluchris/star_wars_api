<?php

namespace  App\Services;
use GuzzleHttp\Client;

abstract  class BaseService{
    public function __construct(Client $HttpClient)
    {
        $this->http_client = $HttpClient;
    }
}
