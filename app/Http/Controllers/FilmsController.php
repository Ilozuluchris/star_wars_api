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
use App\Interfaces\CommentRepositoryInterface;
use App\Services\FilmsService;


class FilmsController extends Controller
{
    /**
     *  Displaying a list of resources
     * @param FilmsService $filmsService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FilmsService $filmsService, CommentRepositoryInterface $repository)
    {
        $films = $filmsService->allFilms($repository);
        return response()->json($films, 200);
    }

}
