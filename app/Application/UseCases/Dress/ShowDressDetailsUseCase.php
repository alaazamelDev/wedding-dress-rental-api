<?php

namespace App\Application\UseCases\Dress;

class ShowDressDetailsUseCase extends DressBaseUseCase
{

    public function execute($data = null)
    {
        return $this->getRepository()->getById($data);
    }
}
