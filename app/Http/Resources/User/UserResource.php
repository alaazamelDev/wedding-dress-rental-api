<?php

namespace App\Http\Resources\User;

use App\Infrastructure\Models\User;
use App\Utilities\FileStorageHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'profile_pic_url' => FileStorageHelper::getFullUrl($this->profile_pic_url),
            'birth_date' => $this->birth_date?->format('Y-m-d'),
            'email' => $this->email,
        ];
    }
}
