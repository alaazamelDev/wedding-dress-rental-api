<?php

namespace App\Application\DTOs;

class ReservationDTO extends BaseDTO
{

    public static function fromCreateRequest($data): array
    {
        return [
            'dress_id' => $data['dress_id'],
            'duration' => $data['duration'],
        ];
    }

    public static function fromUpdateRequest($id, $data = null): array
    {
        return [
            'id' => $id,
        ];
    }
}
