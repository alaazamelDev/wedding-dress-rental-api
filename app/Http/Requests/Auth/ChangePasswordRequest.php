<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'exists:users,email',
                'lowercase'
            ],
            'old_password' => ['required', 'string'],
            'new_password' => [
                'required',
                'string',
                'min:8', // At least 8 characters
                'max:255', // Max length for passwords
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&]/', // At least one special character
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a valid string.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The provided email does not match our records.',
            'old_password.required' => 'The old_password field is required.',
            'old_password.string' => 'The old_password must be a valid string.',
            'new_password.required' => 'The new_password is required.',
            'new_password.min' => 'The new_password must be at least 8 characters long.',
            'new_password.regex' => 'The new_password must include at least one lowercase letter, one uppercase letter, one number, and one special character.',
        ];
    }
}
