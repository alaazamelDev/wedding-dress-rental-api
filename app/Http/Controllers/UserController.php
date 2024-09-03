<?php

namespace App\Http\Controllers;

use App\Domain\Services\UserService;
use App\Http\Resources\Reservation\ReservationResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserReservations(Request $request)
    {
        $user_id = $request->user()->id;
        $reservations = $this->userService->getReservations($user_id);
        return ReservationResource::collection($reservations);
    }
}
