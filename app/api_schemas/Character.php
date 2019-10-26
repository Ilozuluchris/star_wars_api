<?php
#todo move to individual  classes under folder api_schema/characters
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


/**
 * @OA\Schema()
 */
class CharactersMeta{
    /**
     * @var integer
     * @OA\Property()
     */
    public $total_count;


    /**
     * @OA\Property(ref="#/components/schemas/HeightMeta")
     */
    public $total_height;
}



/**
 * @OA\Schema()
 */
class HeightMeta{
    /**
     *  Height in cm
     * @var integer
     * @OA\Property()
     *
     */
    public $cm;

    /**
     *  Feet representation of height
     * @var integer
     * @OA\Property(ref="#/components/schemas/FeetHeight")
     *
     */
    public $feet;
}



/**
 * @OA\Schema()
 */
class FeetHeight{
    /**
     *  Height in feet
     * @var integer
     * @OA\Property()
     *
     */
    public $feet;

    /**
     *  Height in inches
     * @var float
     * @OA\Property(example=0.00)
     *
     */
    public $inches;
}


/**
 * @OA\Schema()
 */
class Characters{


    /**
     *  List of characters
     * @var array
     *
     * @OA\Property(
     *     @OA\Items(ref="#/components/schemas/Character")
     * )
     *
     */
    public $data;


    /**
     * Meta data  about characters
     * @OA\Property(ref="#/components/schemas/CharactersMeta")
     */
    public $meta;
}
