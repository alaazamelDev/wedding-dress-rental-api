<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ForbiddenException extends Exception
{
    public function __construct(
        string     $message = "You don't have permissions to take this action",
        int        $code = 403,
        ?Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
