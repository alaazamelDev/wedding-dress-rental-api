<?php

namespace App\Http\Controllers;

use App\Application\Datatables\DressDatatable;
use App\Domain\Services\DressService;
use App\Http\Resources\Dress\DressBriefResource;
use App\Http\Resources\Dress\DressDetailedResource;
use App\Utilities\ApiResponse;
use Illuminate\Http\Request;

class DressController extends Controller
{
    private DressService $dressService;

    public function __construct(DressService $dressService)
    {
        $this->dressService = $dressService;
    }

    public function index(Request $request)
    {
        $data = DressDatatable::execute($request);
        return DressBriefResource::collection($data);
    }

    public function show($id)
    {
        $result = $this->dressService->showDressDetails($id);
        if (!isset($result)) {
            return ApiResponse::notFound("Dress with ID=" . $id . " was not found");
        }

        $resource = new DressDetailedResource($result);
        return ApiResponse::success($resource);
    }
}
