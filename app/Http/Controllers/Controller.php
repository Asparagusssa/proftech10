<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * Обрабатывает успешный ответ.
     *
     * @param  mixed  $data
     * @param  int  $status
     * @return JsonResponse
     */
    protected function successResponse(mixed $data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * Обрабатывает ошибку.
     *
     * @param  \Exception  $exception
     * @return JsonResponse
     */
    protected function errorResponse(\Throwable $exception): JsonResponse
    {
        $statusCode = $exception->getCode() > 0 ? $exception->getCode() : 500;

        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
        ], $statusCode);
    }
}
