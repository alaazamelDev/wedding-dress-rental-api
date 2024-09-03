<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048', // Max 2MB size
            ],
            'birth_date' => [
                'required',
                'date',
                'before:today', // birth_date must be in the past
                'after:1900-01-01',
                'date_format:Y-m-d'
            ],
            'email' => [
                'required',
                'email',
                'max:254', // Email max length to fit within common email length constraints
                'unique:users,email', // Ensure email is unique in the users table
            ],
            'password' => [
                'required',
                'string',
                'min:8', // At least 8 characters
                'max:255', // Max length for passwords
                'confirmed', // Must match the password_confirmation field
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&]/', // At least one special character
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
            'profile_picture.image' => 'The profile picture must be a valid image file.',
            'profile_picture.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg, gif, svg.',
            'profile_picture.max' => 'The profile picture may not be greater than 2MB.',
            'birth_date.required' => 'The birth date is required.',
            'birth_date.date' => 'The birth date must be a valid date.',
            'birth_date.before' => 'The birth date must be before today.',
            'birth_date.after' => 'The birth date must be after January 1, 1900.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 254 characters.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must include at least one lowercase letter, one uppercase letter, one number, and one special character.',
        ];
    }
}

