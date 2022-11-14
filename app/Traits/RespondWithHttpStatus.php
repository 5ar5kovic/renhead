<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait RespondWithHttpStatus
{
    /**
     * Create a successful json response
     *
     * @param string $message
     * @param int $status
     * @param mixed $data
     * @return JsonResponse
     */
    private function success(string $message, int $status = 200, mixed $data = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Create an error json response
     *
     * @param string $message
     * @param int $status
     * @param mixed $data
     * @return JsonResponse
     */
    private function failure(string $message, int $status = 422, mixed $data = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
