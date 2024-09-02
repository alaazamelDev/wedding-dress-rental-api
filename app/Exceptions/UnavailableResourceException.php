<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class UnavailableResourceException extends Exception
{
    public function __construct(
        string     $message = "The required resource is not available",
        int        $code = 0,
        ?Throwable $previous = null,
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
