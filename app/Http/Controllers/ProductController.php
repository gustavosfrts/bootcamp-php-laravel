<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Traits\RequestTrait;
class ProductController extends Controller
{
    use RequestTrait;
    public function listAllProducts(): JsonResponse
    {
        try
        {
            return $this->APIReturn(Product::get()->load(['pictures'])->toArray(), null, 200);
        }
        catch (\Throwable $exception)
        {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
}
