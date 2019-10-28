<?php

namespace App\Interfaces;

interface CommentRepositoryInterface{
    /** Save a comment getting
     * necessary fields from array passed in.
     * @param array $params
     * @return mixed
     */
    public function save(array $params);

    /** Count no of comments for film  in database.
     * @param int $film_episode_id Identifier for film
     * @return int
     */
    public function countForFilm(int $film_episode_id):int;

    /*** Gets all comments for a film in database
     * @param int $film_episode_id Identifier for film
     * @return mixed
     */
    public function allForFilm(int $film_episode_id);
}