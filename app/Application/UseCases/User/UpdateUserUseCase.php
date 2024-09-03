<?php

namespace App\Application\UseCases\User;

class UpdateUserUseCase extends UserBaseUseCase
{

    public function execute($data = null)
    {
        return $this->getRepository()->updateUser($data);
    }
}
