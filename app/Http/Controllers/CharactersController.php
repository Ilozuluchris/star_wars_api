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
     * @OA\Get(
     *      path="/api/films/{film_episode_id}/characters",
     *      operationId="getProjectsList",
     *      tags={"characters"},
     *      summary="Get list of characters in star wars film",
     *      description="Returns list of characters in a star wars film described by id passed in.",
     *      @OA\Parameter(
     *         description="Episode id of film",
     *         in="path",
     *         name="film_episode_id",
     *         required=true,
     *         @OA\Schema(
     *           schema="film_episode_id",
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(type="array",
     *                          @OA\Items(ref="#/components/schemas/Character")
     *          ),
     *     ),
     *       @OA\Response(response=500, description="Bad request"),*
     *     )
     *
     * Returns list of characters in a star wars film described by id passed in.
     */

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
