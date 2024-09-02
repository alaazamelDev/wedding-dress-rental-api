<?php

namespace App\Http\Controllers;

use App\Application\DTOs\ReservationDTO;
use App\Domain\Services\ReservationService;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnavailableResourceException;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Utilities\ApiResponse;

class ReservationController extends Controller
{
    private ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function create(CreateReservationRequest $request)
    {   // TODO: FIX IT
        $user_id = /*$request->user()->id*/1;
        $validated = $request->validated();
        $data = ReservationDTO::fromRequest($validated);
        $data['user_id'] = $user_id;

        try {
            $result = $this->reservationService->create($data);
            $parsed = new ReservationResource($result);
            return ApiResponse::success($parsed);
        } catch (NotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (UnavailableResourceException $e) {
            return ApiResponse::error($e->getMessage());
        }
    }
}
