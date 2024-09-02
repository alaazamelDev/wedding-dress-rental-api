<?php

namespace App\Infrastructure\Repositories;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnavailableResourceException;
use App\Infrastructure\Models\Dress;
use App\Infrastructure\Models\Reservation;

class ReservationRepository
{
    /**
     * @throws NotFoundException
     * @throws UnavailableResourceException
     */
    public function reserveDress($data)
    {
        // first, check if the dress exists.
        $dress_id = $data['dress_id'];
        $dress = Dress::query()
            ->with('reservations')
            ->find($dress_id);
        if (!isset($dress)) {
            throw new NotFoundException(code: 404);
        }

        // check if the dress is available for reservation
        if (!$dress->is_available) {
            throw new UnavailableResourceException(code: 400);
        }

        // reserve it.
        $rental_price_per_day = $dress->rental_price;
        $expected_total_rental_price = $rental_price_per_day * $data['duration'];

        $created = Reservation::query()
            ->create([
                'dress_id' => $dress_id,
                'user_id' => $data['user_id'],
                'start_date' => now(),
                'rental_price_per_day' => $rental_price_per_day,
                'expected_due_date' => now()->addDays($data['duration']),
                'expected_rental_price' => $expected_total_rental_price,
                'total_rental_price' => null,
                'end_date' => null,
            ]);

        // return it with details
        return Reservation::query()
            ->with(['dress', 'user'])
            ->find($created->id);
    }
}
