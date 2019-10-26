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


/**
 * @OA\Schema(
 *   schema="meta",
 *     @OA\Property(property="total_count",type="integer"),
 *     @OA\Property(property="total_height",ref="#/components/schemas/HeightMeta")
 * )
 *      ),
 * )
 */



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
     * @var integer
     * @OA\Property()
     *
     */
    public $inches;
}
