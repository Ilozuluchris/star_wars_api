<?php

namespace  App\Repositories;

use App\Comment;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\QueryException;


class CommentEloquentRepository implements CommentRepositoryInterface{

    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function all(){
        // TODO: Implement all() method.
        return $this->comment::orderBy('created_at','DESC')->get();
    }

    public function countForFilm(int $film_episode_id):int{
        // TODO: Implement countForFilm() method.
        $count =  $this->comment->where('film_episode_id', $film_episode_id)->count();
       return $count;
    }

    public function save(array $params)
    {
        return $this->comment::create($params);
    }
}

