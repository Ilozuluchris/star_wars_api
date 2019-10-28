<?php

/**
 * @OA\Schema(description="Format for errors")
 */
class ErrorMessage{
    /**
     * @var string
     * @OA\Property()
     */
    public $error;
}
