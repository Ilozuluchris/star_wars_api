<?php

namespace App\Interfaces;

interface CommentRepositoryInterface{
    public function save();
    public function countForFilm($film_episode_id);
    public function all();
}