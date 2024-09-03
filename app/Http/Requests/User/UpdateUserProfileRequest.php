<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Max 2MB size
            ],
            'birth_date' => [
                'nullable',
                'date',
                'before:today', // birth_date must be in the past
                'after:1900-01-01',
                'date_format:Y-m-d'
            ],
            'email' => [
                'nullable',
                'email',
                'max:254', // Email max length to fit within common email length constraints
                'unique:users,email,' . $this->user()->id, // Ensure email is unique in the users table
                'lowercase'
            ],
        ];
    }
}
