<?php

namespace App\Application\DTOs;

use Carbon\Carbon;

class UserDTO extends BaseDTO
{

    public static function fromCreateRequest($data): array
    {
        return [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'profile_pic_url' => $data['profile_picture'] ?? null,
            'birth_date' => Carbon::createFromFormat('Y-m-d', $data['birth_date']),
            'email' => $data['email'],
            'password' => $data['password'],
        ];
    }
}
