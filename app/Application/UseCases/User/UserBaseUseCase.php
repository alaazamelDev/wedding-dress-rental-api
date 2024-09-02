<?php

namespace App\Application\UseCases\User;

use App\Infrastructure\Repositories\UserRepository;

abstract class UserBaseUseCase
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function getRepository(): UserRepository
    {
        return $this->repository;
    }

    public abstract function execute($data = null);
}
