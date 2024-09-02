<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dress_id' => ['required', 'exists:dresses,id'],
            'duration' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }
}
