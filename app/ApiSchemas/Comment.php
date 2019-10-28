<?php

/**
 * @OA\Schema()
 */
class Comment{

    /**
     * @var int
     * @OA\Property()
     */
    public $film_episode_id;


    /**
     * @var string
     * @OA\Property()
     */
    public $content;


    /**
     * @var string
     * @OA\Property()
     */
    public $commenter_ip;

    /**
     * @var string
     * @OA\Property()
     */
    public $created_at;


}