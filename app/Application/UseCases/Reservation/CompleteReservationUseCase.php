<?php

namespace App\Application\UseCases\Reservation;

use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;

class CompleteReservationUseCase extends ReservationBaseUseCase
{

    /**
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws BadRequestException
     */
    public function execute($data = null)
    {
        return $this->getRepository()->completeReservation($data);
    }
}
