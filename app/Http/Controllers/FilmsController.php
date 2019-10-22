<?php

namespace App\Http\Controllers;

use App\Exceptions\SwApiException;
use App\Http\Resources\Film;
use App\Http\Resources\FilmCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        try{
            $res = $client->get('https://swapi.co/api/films/');
        }
        catch (RequestException $e){
            #todo log actual error
            throw  new SwApiException('Error getting list of films from swapi.com');
        }
        $contents = $res->getBody()->getContents();
        $json_content =  json_decode($contents, true);
        $results = $json_content['results'][0];
//        echo gettype($results);
//        dd($results);
//        return new Film($results);
//        dd($json_content);
//        return response()->json($json_content, 200);
        return new Film($results);
    }

}
