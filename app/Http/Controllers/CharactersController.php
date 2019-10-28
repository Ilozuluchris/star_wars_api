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
     *      operationId="getCharacterList",
     *      tags={"Characters"},
     *      summary="Get list of characters in star wars film",
     *      description="Returns list of characters in a star wars film identified by film_episode_id passed in.",
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
     *     @OA\Parameter(
     *     description="Parameter to sort by",
     *     name="sort",
     *     in="query",
     *     @OA\Schema(
     *         type="array",
     *           @OA\Items(
     *               type="string",
     *               enum={"name", "height", "gender"},
     *           ),
     *         ),
     *    ),
     *    @OA\Parameter(
     *     description="Order sorted resulted by, only used when sort parameter is present",
     *     name="order",
     *     in="query",
     *     @OA\Schema(
     *         type="array",
     *           @OA\Items(
     *               type="string",
     *               enum={"desc","asc"},
     *               default="asc"
     *           ),
     *         ),
     *    ),
     *     @OA\Parameter(
     *     description="Filter characters by gender",
     *     name="filter",
     *     in="query",
     *     @OA\Schema(
     *         type="array",
     *           @OA\Items(
     *               type="string",
     *               enum={"male","female","unknown","n/a","hermaphrodite"},
     *               default="asc"
     *           ),
     *         ),
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Characters"),
     *     ),
     *       @OA\Response(response=500, description="Bad request",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorMessage")
     *      ),
     *     )
     *
     * Returns list of characters in a star wars film described by id passed in.
     */


    /** Return list of chracters in  film
     * @param int $film_episode_id identifier for film
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $film_episode_id, Request $request)
    {
        // name, gender or height
        //order desc asc
        // filter by gender
        $query_params = collect([
            'sort'=>$request->input('sort'),
            'order'=>$request->input('order'),
            'filter'=>$request->input('filter'),
        ]);
        $characters = $this->service->charactersByFilm($film_episode_id, $query_params);
        return response()->json($characters, 200);

    }
}
