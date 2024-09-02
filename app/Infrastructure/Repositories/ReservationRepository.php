<?php

namespace App\Infrastructure\Repositories;

use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Infrastructure\Models\Dress;
use App\Infrastructure\Models\Reservation;

class ReservationRepository
{
    /**
     * @throws NotFoundException
     * @throws BadRequestException
     */
    public function reserveDress($data)
    {
        // first, check if the dress exists.
        $dress_id = $data['dress_id'];
        $dress = Dress::query()
            ->with('reservations')
            ->find($dress_id);
        if (!isset($dress)) {
            throw new NotFoundException();
        }

        // check if the dress is available for reservation
        if (!$dress->is_available) {
            throw new BadRequestException();
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

    /**
     * @throws NotFoundException
     * @throws ForbiddenException
     * @throws BadRequestException
     */
    public function completeReservation($data)
    {

        $reservation_id = $data['id'];
        $reservation = Reservation::find($reservation_id);

        // first, check for existence of reservation
        if (!isset($reservation)) {
            throw new NotFoundException();
        }

        // check if the user is the owner
        $user_id = $data['user_id'];
        if ($reservation->user_id != $user_id) {
            throw new ForbiddenException();
        }

        // check if the reservation is already completed
        if (isset($reservation->end_date)) {
            throw new BadRequestException(message: "The reservation is already completed!");
        }

        // compute the actual rental price
        $rental_price_per_day = $reservation->rental_price_per_day;
        $actual_duration = max($reservation->expected_due_date->copy()->diffInDays($reservation->start_date), 1);
        $total_rental_price = max(($actual_duration * $rental_price_per_day), $reservation->expected_rental_price);

        // update the reservation record.
        $reservation->update([
            'total_rental_price' => $total_rental_price,
            'end_date' => now(),
        ]);

        return Reservation::query()
            ->with(['user', 'dress'])
            ->find($reservation_id);
    }
}
