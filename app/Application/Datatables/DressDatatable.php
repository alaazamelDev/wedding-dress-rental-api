<?php

namespace App\Application\Datatables;

use App\Infrastructure\Models\Dress;

class DressDatatable implements BaseDatatable
{

    public static function execute($request)
    {
        $per_page = $request->per_page ?? 10;
        return Dress::query()
            ->select(['id', 'name', 'image_url', 'rental_price'])
            ->paginate($per_page);
    }
}
