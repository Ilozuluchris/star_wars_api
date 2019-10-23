<?php

/**
 * @OA\Schema()
 */
class Film{
    /**
     * The film title
     * @var string
     * @OA\Property()
     */
    public $title;

    /**
     * Episode id for film
     * @var int
     * @OA\Property()
     */

    public $episode_id;

    /**
     * The release date for film
     * @var string
     * @OA\Property()
     */
    public $release_date;


    /**
     * Number of comments film has
     * @var int
     * @OA\Property()
     */
    public $comment_count;




}