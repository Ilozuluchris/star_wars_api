<?php

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
* @OA\Property(ref="#/components/schemas/Height")
*/
public $total_height;
}
