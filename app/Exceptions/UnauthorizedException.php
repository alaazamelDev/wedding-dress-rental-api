<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class UnauthorizedException extends Exception
{

    public function __construct(
        string     $message = "You are not authorized",
        int        $code = 401,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
