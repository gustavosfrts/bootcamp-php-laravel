<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Product;
use App\Traits\RequestTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PictureController extends Controller
{
    use RequestTrait;
    public function uploadPictures(int $productId, Request $request): JsonResponse
    {
        try {
            if (Product::find($productId))
            {
                if ($request->file('pictures'))
                {
                    $pictures = $request->file('pictures');
                    foreach ($pictures as $picture)
                    {
                        $fileName = date('YmdHis') . $picture->getClientOriginalName();
                        $picture->move(public_path('storage/product'), $fileName);
                        Picture::create([
                            'path' => URL::to('/storage/product/' . $fileName),
                            'product_id' => $productId
                        ]);
                    }

                    return $this->APIReturn(null, null);
                }
                return $this->APIReturn(null, ['Não encontrado a imagem.'], 400);
            }
            return $this->APIReturn(null, ['Produto não existe.'], 400);
        } catch (\Throwable $exception) {
            return $this->APIReturn(null, [$exception->getMessage()], 500);
        }
    }
}
