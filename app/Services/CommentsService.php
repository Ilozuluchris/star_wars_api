<?php

namespace App\Services;


use App\Http\Resources\CommentResource;
use App\Interfaces\CommentRepositoryInterface;

class CommentsService{

    public function __construct(CommentRepositoryInterface $commentRepository )
    {
        $this->repository = $commentRepository;
    }

    public function saveNewComment($comment_data){

        $saved_comment = $this->repository->save($comment_data);
        return new CommentResource($saved_comment);

    }
}