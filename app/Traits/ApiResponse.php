<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Respuesta exitosa.
     */
    protected function successResponse(
        $data = null,
        $message = '',
        $status = 200
    ) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $status);
    }

    /**
     * Respuesta de error.
     */
    protected function errorResponse(
        $message = '',
        $status = 400,
        $errors = null
    ) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => $errors
        ], $status);
    }
}