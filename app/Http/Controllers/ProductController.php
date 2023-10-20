<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use RequestTrait;
    public function listAllProducts(): JsonResponse
    {
        try {
            return $this->APIReturn(Product::get()->load(['pictures'])->toArray(), null, 200);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
    public function listSingleProduct(int $id): JsonResponse
    {
        try
        {
            $produto = Product::where('id', $id)->first();
            if (isset($produto))
            {
                $produto = $produto->load(['pictures']);
                return $this->APIReturn($produto, null, 200);
            }
            else
            {
                return $this->APIReturn(null, ['Produto não encontrado.'], 404);
            }
        } catch (\Throwable $exception)
        {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }

    public function createProduct(Request $request): JsonResponse
    {
        try {
            return $this->APIReturn(null, null, 200);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
}
