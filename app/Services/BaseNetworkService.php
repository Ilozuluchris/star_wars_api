<?php

namespace  App\Services;
use App\Exceptions\SwapiGetException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/** Class containing logic for calls to external apis.
 * Every class making calls to external apis needs to extend this.
 * Class BaseNetworkService
 * @package App\Services
 */
abstract  class BaseNetworkService{
    use CacheResponseService;

    public function __construct(Client $HttpClient)
    {
        $this->http_client = $HttpClient;
    }


    /** Makes external get request to url and saves results to cache.
     * @param string $url url to make query to
     * @return array
     * @throws SwapiGetException
     */
    private function fetchFromUrl($url):array{
        try{
            $res = $this->http_client->get($url);
        }
        catch (RequestException $e){
            throw  new SwapiGetException("Query on ".$url." failed. Reason ".$e->getMessage());
        }
        $contents = json_decode($res->getBody()->getContents(), true);
        $this->addToCache($url, $contents, $res->getStatusCode());
        return $contents;
    }

    /** Get contents from url.
     * Returns from cache if present,if not makes external call to url.
     * @param string $url
     * @return array
     */
    public function getUrl(string $url):array{

        $contents = $this->getFromCache($url)??$this->fetchFromUrl($url);
        return $contents;
    }
}
