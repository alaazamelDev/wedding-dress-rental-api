<?php

namespace App\Application\UseCases\Reservation;

use App\Infrastructure\Repositories\ReservationRepository;

abstract class ReservationBaseUseCase
{
    private ReservationRepository $repository;

    public function __construct(ReservationRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function getRepository(): ReservationRepository
    {
        return $this->repository;
    }

    public abstract function execute($data = null);
}
