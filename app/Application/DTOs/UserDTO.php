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

    public static function fromUpdateRequest($id, $data = null): array
    {
        $payload = [
            'id' => $id,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'profile_pic_url' => $data['profile_picture'] ?? null,
            'birth_date' => isset($data['birth_date'])
                ? Carbon::createFromFormat('Y-m-d', $data['birth_date'])
                : null,
            'email' => $data['email'] ?? null,
            'password' => $data['old_password'] ?? null,
            'new_password' => $data['new_password'] ?? null,
        ];

        // filter out null values from the payload
        return array_filter($payload, function ($value) {
            return !is_null($value); // explicitly remove null values
        });

    }

    public static function fromLoginRequest($data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password']
        ];
    }
}
