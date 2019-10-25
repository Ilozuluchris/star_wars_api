<?php

namespace App\Interfaces;

interface CommentRepositoryInterface{
    public function save();
    public function countForFilm(int $film_episode_id):int;
    public function all();
}