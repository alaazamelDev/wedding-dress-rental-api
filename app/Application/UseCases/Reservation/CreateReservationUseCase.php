<?php

namespace App\Application\UseCases\Reservation;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnavailableResourceException;

class CreateReservationUseCase extends ReservationBaseUseCase
{

    /**
     * @throws UnavailableResourceException
     * @throws NotFoundException
     */
    public function execute($data = null)
    {
        return $this->getRepository()->reserveDress($data);
    }
}
