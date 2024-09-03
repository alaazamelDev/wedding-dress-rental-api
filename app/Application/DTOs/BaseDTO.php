<?php

namespace App\Application\DTOs;

abstract class BaseDTO
{

    public abstract static function fromCreateRequest($data);

    public static function fromUpdateRequest($id, $data = null): array
    {
        return [];
    }

}
