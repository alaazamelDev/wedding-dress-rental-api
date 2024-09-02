<?php

namespace App\Application\DTOs;

abstract class BaseDTO
{

    public abstract static function fromRequest($data);

    public static function fromUpdateRequest($data = null): array
    {
        return [];
    }

}
