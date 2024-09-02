<?php

namespace App\Application\DTOs;

class ReservationDTO extends BaseDTO
{

    public static function fromRequest($data): array
    {
        return [
            'dress_id' => $data['dress_id'],
            'duration' => $data['duration'],
        ];
    }
}
