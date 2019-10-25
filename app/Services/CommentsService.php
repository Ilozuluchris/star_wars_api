<?php

namespace App\Services;


use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentResourceCollection;
use App\Interfaces\CommentRepositoryInterface;

class CommentsService{

    public function __construct(CommentRepositoryInterface $commentRepository )
    {
        $this->repository = $commentRepository;
    }

    public function getAllComments(){
        $all_comments = $this->repository->all();
        return new CommentResourceCollection($all_comments);
    }

    public function saveNewComment($comment_data){

        $saved_comment = $this->repository->save($comment_data);
        return new CommentResource($saved_comment);

    }
}