<?php

namespace App\Application\UseCases\User;

class RegisterUserUseCase extends UserBaseUseCase
{

    public function execute($data = null)
    {
        return $this->getRepository()->createUser($data);
    }
}
