<?php

namespace App\Application\Services;

use App\Application\UseCases\User\GetUserByEmailUseCase;
use App\Application\UseCases\User\RegisterUserUseCase;
use App\Application\UseCases\User\UpdateUserUseCase;
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
        $user = app(GetUserByEmailUseCase::class)->execute($data);

        // check the password...
        if (!Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedException("The password is incorrect.");
        }

        // Generate a Sanctum token for the user
        return $user->createToken('auth_token')->plainTextToken;

    }

    /**
     * @throws UnauthorizedException
     */
    public function changePassword(array $data)
    {
        // get the user record that matches the email.
        $user = app(GetUserByEmailUseCase::class)->execute($data);

        // check if the old password is matching.
        if (!Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedException("The old password is incorrect.");
        }

        // now, update the password...
        $new_details = [
            'id' => $data['id'],
            'password' => Hash::make($data['new_password']),
        ];

        // perform the update operation.
        $updated_user = app(UpdateUserUseCase::class)->execute($new_details);

        // revoke all tokens.
        $updated_user->tokens()->delete();

        // generate a new token.
        return $updated_user->createToken('access_token')->plainTextToken;
    }
}
