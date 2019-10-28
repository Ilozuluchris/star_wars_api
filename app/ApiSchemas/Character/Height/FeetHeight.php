<?php

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
* @OA\Property(example=0.01)
*
*/
public $inches;
}
