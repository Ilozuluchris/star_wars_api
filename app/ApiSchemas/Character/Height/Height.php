<?php

/**
 * @OA\Schema()
 */
class Height{
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
    public $feet_height;
}
