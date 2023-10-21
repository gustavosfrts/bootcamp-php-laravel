<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\RequestTrait;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use RequestTrait;
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = auth('api')->attempt($request->all());
            if ($user)
            {
                return $this->APIReturn(['jwt' => $user], null, 200);
            }
            return $this->APIReturn(null, ['Email ou senha incorreto.'], 400);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
}
