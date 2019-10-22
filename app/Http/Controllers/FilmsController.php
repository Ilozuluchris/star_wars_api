<?php

namespace App\Http\Controllers;

use App\Exceptions\SwApiException;
use App\Http\Resources\FilmResource;
use App\Http\Resources\FilmResourceCollection;
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
        $films =  new FilmResourceCollection(FilmResource::collection(collect($json_content['results'])));
        return response()->json($films, 200);
    }

}
