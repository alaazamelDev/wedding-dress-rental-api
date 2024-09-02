<?php

namespace App\Domain\Services;

use App\Application\UseCases\User\GetUserReservationsUseCase;

class UserService
{
    public function getReservations($user_id)
    {
        return app(GetUserReservationsUseCase::class)->execute($user_id);
    }
}
