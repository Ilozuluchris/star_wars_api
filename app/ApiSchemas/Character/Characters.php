<?php
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
