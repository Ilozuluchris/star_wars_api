<?php

/**
 * @OA\Schema()
 */
class Character{

    /**
     *  The name of the character
     * @var string
     * @OA\Property()
     *
     */
    public $name;

    /**
     *  Height of character in cm
     * @var string
     * @OA\Property()
     *
     */
    public $height;

    /**
     *  The gender of the character
     * @var string
     * @OA\Property()
     *
     */
    public $gender;
}