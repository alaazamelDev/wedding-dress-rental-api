<?php

namespace App\Http\Controllers;

use App\Application\DTOs\UserDTO;
use App\Domain\Services\UserService;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Http\Resources\User\UserResource;
use App\Utilities\ApiResponse;
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

    public function updateUserProfile(UpdateUserProfileRequest $request)
    {
        $validated = $request->validated();
        $user_id = $request->user()->id;
        $data = UserDTO::fromUpdateRequest($user_id, $validated);
        $result = $this->userService->updateUserProfile($data);
        $resource = new UserResource($result);
        return ApiResponse::success($resource);
    }
}
