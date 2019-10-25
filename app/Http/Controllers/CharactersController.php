<?php

namespace App\Http\Controllers;

use App\Services\CharactersService;
use Illuminate\Http\Request;

class CharactersController extends Controller
{

    public function __construct(CharactersService $charactersService)
    {
        $this->service = $charactersService;
    }

    /**
     * Display a listing of the resource.
     * @param $film_episode_id
     * @return \Illuminate\Http\Response
     */
    public function index($film_episode_id, Request $request)
    {
        // name, gender or height
        //order desc asc
        // filter by gender
        $query_params = collect([
            'sort'=>$request->input('sort'),
            'order'=>$request->input('order'),
            'filter'=>$request->input('filter'),
        ]);
        return $this->service->charactersByFilm($film_episode_id, $query_params);

    }
}
