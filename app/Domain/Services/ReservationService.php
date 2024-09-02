<?php

namespace App\Domain\Services;

use App\Application\UseCases\Reservation\CreateReservationUseCase;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnavailableResourceException;

class ReservationService
{
    /**
     * @throws UnavailableResourceException
     * @throws NotFoundException
     */
    public function create(array $data)
    {
        return app(CreateReservationUseCase::class)->execute($data);
    }
}
