<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

trait ApiResponse
{
    public function sendSuccess($data = [], $message = 'successful', $statusCode = 200, $metadata = null)    {
        // Return response
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'metadata' => $metadata,
        ], $statusCode);
    }

    public function sendError($error = [], $message = 'there was an error', $statusCode = 500)    {
        // Return response
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $error,
        ], $statusCode ?? 500);
    }
}
