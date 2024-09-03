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

    public function findUserByEmail($data)
    {
        return User::query()
            ->where('email', $data['email'])
            ->first();
    }

    public function updateUser($data)
    {
        // update the user data.
        $updated = User::query()
            ->whereId($data['id'])
            ->update($data);

        return User::find($data['id']);
    }
}
