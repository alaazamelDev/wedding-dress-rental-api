<?php

namespace App\Application\UseCases\User;

class GetUserReservationsUseCase extends UserBaseUseCase
{

    public function execute($data = null)
    {
        return $this->getRepository()->getReservations($data);
    }
}
