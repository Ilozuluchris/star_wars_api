<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Interfaces\CommentRepositoryInterface;
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
    public function store(Request $request)
    {
        $saved_comment = $this->repository->save($request->all());
        return response()->json(
            ['data'=>$saved_comment], 201
        );
    }

}
