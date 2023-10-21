<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use RequestTrait;
    /**
     * @OA\Get(
     *     path="/api/product/",
     *     summary="Retorna listagem de produtos",
     *     tags={"Product"},
     *     operationId="getProducts",
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="title", type="string"),
     *                     @OA\Property(property="description", type="string"),
     *                     @OA\Property(property="price", type="number", format="float"),
     *                     @OA\Property(property="promotional_price", type="number", format="float", nullable=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time"),
     *                     @OA\Property(
     *                         property="pictures",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer"),
     *                             @OA\Property(property="path", type="string"),
     *                             @OA\Property(property="product_id", type="integer"),
     *                         ),
     *                     ),
     *                 ),
     *             ),
     *             @OA\Property(property="errors", type="string"),
     *         ),
     *     ),
     * )
     */
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

    public function createProduct(ProductRequest $request): JsonResponse
    {
        try {
            $produto = Product::create($request->all());
            return $this->APIReturn($produto, null, 200);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
    public function updateProduct(int $id, ProductRequest $request): JsonResponse
    {
        try {
            $produto = Product::find($id);
            if (!isset($produto))
            {
                return $this->APIReturn(null, ['Produto não encontrado'], 400);
            }

            $produto->update($request->all());
            return $this->APIReturn($produto, null, 200);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
    public function deleteProduct(int $id): JsonResponse
    {
        try {
            $product = Product::find($id);
            if($product)
            {
                if (Picture::deletePicture($id))
                {
                    $product->delete();
                }
                return $this->APIReturn(null, null);
            }
            return $this->APIReturn(null, ['Produto não encontrado.'], 404);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
}
