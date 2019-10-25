<?php

namespace App\Http\Controllers;

use App\Services\CharactersService;
use App\Services\CommentsService;
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
    public function index($film_episode_id)
    {
        //
        return $this->service->charactersByFilm($film_episode_id);

    }
}
