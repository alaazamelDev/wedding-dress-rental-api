<?php

namespace App\Application\Services;

use App\Application\UseCases\User\LoginUserUseCase;
use App\Application\UseCases\User\RegisterUserUseCase;
use App\Exceptions\UnauthorizedException;
use App\Utilities\FileStorageHelper;
use Hash;

class AuthService
{
    /**
     * @param array $data
     * @return string
     * @description we will be implementing authentication logic
     */
    public function register(array $data): string
    {
        // First, store the file if exists
        if (isset($data['profile_pic_url'])) {

            $storedFilePath = FileStorageHelper::storeFile($data['profile_pic_url']);

            // Replace the profile picture URL in the data with the stored file path
            if ($storedFilePath) {
                $data['profile_pic_url'] = $storedFilePath;
            }

        }

        // Then, Hash the password.
        $data['password'] = Hash::make($data['password']);


        // Execute the register use case and get the stored user model
        $user = app(RegisterUserUseCase::class)->execute($data);


        // Generate a Sanctum token for the registered user
        return $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * @throws UnauthorizedException
     */
    public function login(array $data)
    {
        // get the user record that matches the email.
        $user = app(LoginUserUseCase::class)->execute($data);

        // check the password...
        if (!Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedException("The password is incorrect.");
        }

        // Generate a Sanctum token for the user
        return $user->createToken('auth_token')->plainTextToken;

    }
}
