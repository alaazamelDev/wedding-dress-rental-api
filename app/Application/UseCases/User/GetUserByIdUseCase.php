<?php

namespace App\Application\UseCases\User;

class GetUserByIdUseCase extends UserBaseUseCase
{

    public function execute($data = null)
    {
        return $this->getRepository()->findById($data);
    }
}
