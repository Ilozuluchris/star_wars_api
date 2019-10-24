<?php

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="STAR WARS API",
 *      description="STAR WARS API Swagger OpenApi description",
 *      @OA\Contact(
 *          email="ilozuluchidiuso@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 * @OA\Get(
 *      path="/api/films",
 *      operationId="getProjectsList",
 *      tags={"Films"},
 *      summary="Get list of star wars films",
 *      description="Returns list of star wars films",
 *      @OA\Response(
 *          response=200,
 *          description="successful operation",
 *          @OA\JsonContent(type="array",
 *                          @OA\Items(ref="#/components/schemas/Film")
 *          ),
 *     ),
 *       @OA\Response(response=500, description="Bad request"),*
 *     )
 *
 * Returns list of star wars films
 */

namespace App\Http\Controllers;

use App\Exceptions\SwApiException;
use App\Http\Resources\FilmResource;
use App\Http\Resources\FilmResourceCollection;
use App\Services\FilmsService;
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
    public function index(FilmsService $filmsService)
    {
        $films = $filmsService->allFilms();
        return response()->json($films, 200);
    }

}
