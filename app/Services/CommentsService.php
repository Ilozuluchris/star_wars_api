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

    public function commentsForFilm($film_episode_id){
        $all_comments = $this->repository->allForFilm($film_episode_id);
        return new CommentResourceCollection($all_comments);
    }

    public function saveNewComment($comment_data){

        $saved_comment = $this->repository->save($comment_data);
        return new CommentResource($saved_comment);

    }
}