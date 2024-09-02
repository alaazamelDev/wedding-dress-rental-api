<?php

namespace App\Application\UseCases\Reservation;

use App\Exceptions\NotFoundException;
use App\Exceptions\BadRequestException;

class CreateReservationUseCase extends ReservationBaseUseCase
{

    /**
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function execute($data = null)
    {
        return $this->getRepository()->reserveDress($data);
    }
}
