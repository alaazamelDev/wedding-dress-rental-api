<?php

namespace App\Application\UseCases\Dress;

use App\Infrastructure\Repositories\DressRepository;

abstract class DressBaseUseCase
{
    private DressRepository $repository;

    public function __construct(DressRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function getRepository(): DressRepository
    {
        return $this->repository;
    }

    public abstract function execute($data = null);
}
