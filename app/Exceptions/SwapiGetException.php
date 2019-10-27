<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class SwapiGetException extends Exception
{
    //
    public function __construct($message = "",$url, $code = 0, Throwable $previous = null)
    {
        $this->url = $url;
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json([
            'operation'=>"Get request on ".$this->url,
            'error' => $this->getMessage()], 500);
    }
}
