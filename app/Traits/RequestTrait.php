<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use \Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait RequestTrait
{
    public function APIReturn($data, ?array $errors, int $statusCode = 204): JsonResponse
    {
        if (!isset($data) and !isset($errors))
        {
            return response()->json(null, $statusCode);
        }

        $data = [
          'data' => $data,
          'errors' => $errors,
        ];

        return response()->json($data, $statusCode, [], JSON_PRESERVE_ZERO_FRACTION);
    }
    public function failedValidation(Validator $validator): JsonResponse
    {
        $response = self::APIReturn(null, $validator->errors()->all(), 400);
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)->redirectTo($this->getRedirectUrl());
    }
}
