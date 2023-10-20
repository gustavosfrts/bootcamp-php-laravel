<?php

namespace App\Traits;

use \Illuminate\Http\JsonResponse;
trait RequestTrait
{
    public function APIReturn($data, ?array $errors, int $statusCode): JsonResponse
    {
        $data = [
          'data' => $data,
          'errors' => $errors,
        ];

        return response()->json($data, $statusCode, [], JSON_PRESERVE_ZERO_FRACTION);
    }
}
