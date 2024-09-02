<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class BadRequestException extends Exception
{
    public function __construct(
        string     $message = "The required resource is not available",
        int        $code = 400,
        ?Throwable $previous = null,
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
