<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Models\Dress;

class DressRepository
{

    public function getById($id)
    {
        return Dress::query()
            ->with('reservations')
            ->find($id);
    }

}
