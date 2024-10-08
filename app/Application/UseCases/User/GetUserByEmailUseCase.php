<?php

namespace App\Application\UseCases\User;

class GetUserByEmailUseCase extends UserBaseUseCase
{

    public function execute($data = null)
    {
        return $this->getRepository()->findUserByEmail($data);
    }
}
