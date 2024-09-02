<?php

namespace App\Domain\Services;

use App\Application\UseCases\Reservation\CompleteReservationUseCase;
use App\Application\UseCases\Reservation\CreateReservationUseCase;
use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;

class ReservationService
{
    /**
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function create(array $data)
    {
        return app(CreateReservationUseCase::class)->execute($data);
    }

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws BadRequestException
     */
    public function completeReservation(array $data)
    {
        return app(CompleteReservationUseCase::class)->execute($data);
    }
}
