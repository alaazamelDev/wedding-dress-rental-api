<?php

namespace App\Http\Resources\Reservation;

use App\Http\Resources\Dress\DressBriefResource;
use App\Http\Resources\User\UserResource;
use App\Infrastructure\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Reservation */
class ReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'expected_due_date' => $this->expected_due_date?->format('Y-m-d'),
            'expected_rental_price' => $this->expected_rental_price,
            'end_date' => $this->end_date?->format('Y-m-d'),
            'rental_price_per_day' => $this->rental_price_per_day,
            'total_rental_price' => $this->total_rental_price,
            'status' => $this->status,

            'dress' => new DressBriefResource($this->whenLoaded('dress')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
