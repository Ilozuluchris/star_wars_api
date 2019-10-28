<?php

namespace App\Services;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentResourceCollection;
use App\Interfaces\CommentRepositoryInterface;

class CommentsService{

    public function __construct(CommentRepositoryInterface $commentRepository )
    {
        $this->repository = $commentRepository;
    }

    /**  Get all comments for a film
     * @param int $film_episode_id identifier for film
     * @return CommentResourceCollection
     */
    public function commentsForFilm(int $film_episode_id){
        $all_comments = $this->repository->allForFilm($film_episode_id);
        return new CommentResourceCollection($all_comments);
    }

    /** Save comment for a film, ip address of commenter is attached at this point
     * @param CreateCommentRequest $request
     * @param int $film_episode_id identifier for film
     * @return CommentResource
     */
    public function saveNewComment(CreateCommentRequest $request, int $film_episode_id){
        $comment_data = array_merge($request->validated(),['film_episode_id'=>$film_episode_id, 'commenter_ip'=>$request->ip()]);
        $saved_comment = $this->repository->save($comment_data);
        return new CommentResource($saved_comment);

    }
}