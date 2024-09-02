<?php

namespace App\Domain\Services;

use App\Application\UseCases\Dress\ShowDressDetailsUseCase;

class DressService
{

    public function showDressDetails($id)
    {
        return app(ShowDressDetailsUseCase::class)->execute($id);
    }
}
