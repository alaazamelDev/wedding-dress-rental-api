<?php

namespace App\Http\Controllers;

use App\Application\DTOs\UserDTO;
use App\Application\Services\AuthService;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\User\UserResource;
use App\Utilities\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $data = UserDTO::fromCreateRequest($validated);
        $token = $this->authService->register($data);
        return ApiResponse::success(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function getUserDetails(Request $request)
    {
        $user = $request->user();
        $response = new UserResource($user);
        return ApiResponse::success($response);
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();
        $data = UserDTO::fromLoginRequest($validated);
        try {
            $token = $this->authService->login($data);
        } catch (UnauthorizedException $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                status: $e->getCode()
            );
        }
        return ApiResponse::success(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::success("Logged out successfully...");
    }
}
