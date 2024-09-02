<?php

namespace App\Http\Resources\Dress;

use App\Infrastructure\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Dress */
class DressDetailedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_url' => $this->image_url,
            'rental_price' => $this->rental_price,
            'description' => $this->description,
            'size' => $this->size,
            'is_available' => $this->is_available,
        ];
    }
}
