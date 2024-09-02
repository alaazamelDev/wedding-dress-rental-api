<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class CompleteReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reservation_id' => ['required', 'exists:reservations,id'],
        ];
    }
}
