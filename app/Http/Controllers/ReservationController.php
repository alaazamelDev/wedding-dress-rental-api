<?php

namespace App\Http\Controllers;

use App\Application\DTOs\ReservationDTO;
use App\Domain\Services\ReservationService;
use App\Exceptions\BadRequestException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Reservation\CompleteReservationRequest;
use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Utilities\ApiResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function createReservation(CreateReservationRequest $request)
    {
        $user_id = $request->user()->id;
        $validated = $request->validated();
        $data = ReservationDTO::fromCreateRequest($validated);
        $data['user_id'] = $user_id;

        try {
            $result = $this->reservationService->create($data);
            $parsed = new ReservationResource($result);
            return ApiResponse::success($parsed);
        } catch (NotFoundException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (BadRequestException $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function completeReservation(CompleteReservationRequest $request)
    {
//        $user_id = $request->user()->id;
        $validated = $request->validated();
        $data = ReservationDTO::fromUpdateRequest($validated);
//        $data['user_id'] = $user_id;
        $data['user_id'] = 1;

        try {
            $result = $this->reservationService->completeReservation($data);
            $parsed = new ReservationResource($result);
            return ApiResponse::success($parsed);
        } catch (BadRequestException|ForbiddenException|NotFoundException $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                status: $e->getCode(),
            );
        }
    }
}
