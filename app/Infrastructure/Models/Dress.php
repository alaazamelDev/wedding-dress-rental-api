<?php

namespace App\Infrastructure\Models;

use Database\Factories\DressFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dress extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
        'rental_price',
        'description',
        'size',
    ];


    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'dress_id');
    }

    // if one reservation record is active, then the dress is reserved.
    public function getIsAvailableAttribute(): bool
    {
        $active_record = $this->reservations
            ->firstWhere(function (Reservation $reservation) {
                return !isset($reservation->end_date);
            });

        return !isset($active_record);
    }


    protected static function newFactory(): DressFactory|Factory
    {
        return DressFactory::new();
    }
}
