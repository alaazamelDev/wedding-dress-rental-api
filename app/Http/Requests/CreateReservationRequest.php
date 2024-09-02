<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dress_id' => ['required', 'exists:dresses,id'],
            'duration' => ['required', 'integer', 'min:1', 'max:100'],
//            'user_id' => ['required', 'exists:users,id'],
//            'start_date' => ['required', 'date'],
//            'expected_rental_price' => ['required', 'date'],
//            'end_date' => ['nullable', 'date'],
//            'rental_price_per_day' => ['required', 'numeric'],
//            'total_rental_price' => ['nullable', 'numeric'],
        ];
    }
}
