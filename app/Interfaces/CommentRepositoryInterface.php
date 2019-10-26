<?php

namespace App\Interfaces;

interface CommentRepositoryInterface{
    /** Save a comment getting
     * necessary fields from array passed in.
     * @param array $params
     * @return mixed
     */
    public function save(array $params);

    /** Count no of comments film specified by argument has in database.
     * @param int $film_episode_id
     * @return int
     */
    public function countForFilm(int $film_episode_id):int;

    /*** Gets all comments in database
     * @return mixed
     */
    public function allForFilm(int $film_episode_id);
}