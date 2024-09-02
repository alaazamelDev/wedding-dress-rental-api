<?php

namespace App\Utilities;

use Illuminate\Http\JsonResponse;

abstract class ApiResponse
{
    public static function success($data = [], $message = null, $status = 200): JsonResponse
    {
        return response()->json(['data' => $data, 'status_code' => $status], $status);
    }

    public static function error($message, $status = 400): JsonResponse
    {
        return response()->json(['message' => $message, 'status_code' => $status], $status);
    }

    public static function response($status, $code, $message, $data = []): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function notFound(string $message = 'Not Found'): JsonResponse

    {
        return response()->json([
            'message' => $message,
        ], 404);
    }

    public static function validationError($validator): JsonResponse
    {
        return response()->json([
            "status" => "fail",
            "errors" => $validator->errors()
        ], 422);
    }
}
