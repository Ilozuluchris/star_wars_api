<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Interfaces\CommentRepositoryInterface;
use App\Services\CommentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommentsController extends Controller
{

    public function __construct(CommentsService $commentsService)
    {
        $this->service = $commentsService;
    }



    public function index($film_episode_id){
        $all_comments = $this->service->commentsForFilm($film_episode_id);
        return response()->json(
            $all_comments, 200
        );
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    #todo look for way to push data attribute to resource
    public function store(CreateCommentRequest $request, $film_episode_id)
    {

        $new_comment = $this->service->saveNewComment(Arr::add($request->validated(), 'film_episode_id', $film_episode_id));
        return $new_comment->response()->setStatusCode(201);
    }




}
