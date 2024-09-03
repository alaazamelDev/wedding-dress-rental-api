<?php

namespace App\Domain\Services;

use App\Application\UseCases\User\GetUserByIdUseCase;
use App\Application\UseCases\User\GetUserReservationsUseCase;
use App\Application\UseCases\User\UpdateUserUseCase;
use App\Utilities\FileStorageHelper;

class UserService
{
    public function getReservations($user_id)
    {
        return app(GetUserReservationsUseCase::class)->execute($user_id);
    }

    public function updateUserProfile($data)
    {

        // get the use record.
        $user = app(GetUserByIdUseCase::class)->execute($data['id']);

        // check if an image is passed,
        if (isset($data['profile_pic_url'])) {

            // delete the old one if exists.
            if (isset($user->profile_pic_url)) {
                FileStorageHelper::deleteFile($user->profile_pic_url);
            }

            // store the new one
            $storedFilePath = FileStorageHelper::storeFile($data['profile_pic_url']);

            // replace the profile picture URL in the data with the stored file path
            if ($storedFilePath) {
                $data['profile_pic_url'] = $storedFilePath;
            }
        }

        // now, update the fields.
        return app(UpdateUserUseCase::class)->execute($data);
    }
}
