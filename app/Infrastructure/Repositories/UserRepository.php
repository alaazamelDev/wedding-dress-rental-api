<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Models\Reservation;
use App\Infrastructure\Models\User;

class UserRepository
{

    public function getReservations($user_id)
    {
        return Reservation::query()
            ->with(['dress'])
            ->where('user_id', $user_id)
            ->orderByDesc('created_at')
            ->paginate(
                perPage: request('per_page'),
                page: request('page')
            );
    }

    public function createUser($data)
    {
        return User::query()
            ->create($data);
    }
}
