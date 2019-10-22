<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
        $res = $client->get('https://swapi.co/api/films/');
        echo $res->getStatusCode(); // 200
        echo $res->getBody();
//        return $res->getBody();
    }

}
