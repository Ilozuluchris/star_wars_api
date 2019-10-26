<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Services\CommentsService;


class CommentsController extends Controller
{

    public function __construct(CommentsService $commentsService)
    {
        $this->service = $commentsService;
    }


    /**
     * @OA\Get(
     *      path="/api/films/{film_episode_id}/comments",
     *      operationId="getCommentList",
     *      tags={"Comments"},
     *      summary="Get list of comments for a film",
     *      description="Returns list of comments for a star wars film identified by film_episode_id passed in.",
     *      @OA\Parameter(
     *         description="Episode id of film to get comments for",
     *         in="path",
     *        name="film_episode_id",
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
     *                         @OA\Items(ref="#/components/schemas/Comment")
     *          )
     *
     *      ),
     *       @OA\Response(response=500, description="Bad request"),*
     *     )
     *
     */


    public function index($film_episode_id){
        $all_comments = $this->service->commentsForFilm($film_episode_id);
        return response()->json(
            $all_comments, 200
        );
    }


    /**
     * @OA\Post(
     *      path="/api/films/{film_episode_id}/comments",
     *      operationId="addNewComment",
     *      tags={"Comments"},
     *      summary="Add a new comment for a film",
     *      description="Add new comment for a star wars film identified by film_episode_id passed in.`",
     *      @OA\Parameter(
     *         description="Episode id of film to add comment for",
     *         in="path",
     *        name="film_episode_id",
     *         required=true,
     *         @OA\Schema(
     *           schema="film_episode_id",
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Comment object that needs to be saved for film",
     *         required=true,
     *         @OA\JsonContent(example={"content":"string of max length 500"})
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment"
     *          )
     *
     *      ),
     *       @OA\Response(response=500, description="Bad request"),*
     *     )
     *
     */


    /**
     * @param CreateCommentRequest $request
     * @param $film_episode_id
     * @return $this
     */
    #todo look for way to push data attribute to resource
    public function store(CreateCommentRequest $request, $film_episode_id)
    {
        $new_comment = $this->service->saveNewComment($request, $film_episode_id);
        return $new_comment->response()->setStatusCode(201);
    }




}
