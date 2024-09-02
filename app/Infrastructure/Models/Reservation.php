<?php

namespace App\Infrastructure\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{

    protected $fillable = [
        'user_id',
        'dress_id',
        'start_date',
        'expected_due_date',
        'expected_rental_price',
        'end_date',
        'rental_price_per_day',
        'total_rental_price',
    ];


    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'expected_due_date' => 'date',
        'rental_price_per_day' => 'double',
        'total_rental_price' => 'double',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dress(): BelongsTo
    {
        return $this->belongsTo(Dress::class);
    }


    public function getStatusAttribute(): string
    {
        $today = Carbon::today();

        // Completed status if end_date is set (so, it's over)
        if ($this->end_date) {
            return 'Completed';
        }

        // Active status if today is between start_date and expected_due_date
        if ($today->between($this->start_date, $this->expected_due_date)) {
            return 'Active';
        }

        // Overdue status if today is past expected_due_date
        if ($today->gt($this->expected_due_date)) {
            return 'Overdue';
        }

        // Otherwise, Pending...
        return 'Pending';
    }

}
