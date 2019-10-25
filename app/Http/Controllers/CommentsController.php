<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Interfaces\CommentRepositoryInterface;
use App\Services\CommentsService;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->repository = $commentRepository;
    }


    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request,CommentsService $commentsService)
    {

        $new_comment = $commentsService->saveNewComment($request->validated());
        return response()->json(
            $new_comment, 201
        );
    }

}
