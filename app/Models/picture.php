<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Picture extends Model
{
    use HasFactory;
    protected $table = 'pictures';
    protected $fillable = [
        'path',
        'product_id',
    ];
    public static function deletePicture(int $productId): bool
    {
        try{
            $pictures = self::where('product_id', $productId)->get();
            if (isset($pictures))
            {
                foreach ($pictures as $picture)
                {
                    $picPath = public_path('storage/product/') . explode('/storage/product/', $picture->path)[1];
                    if (File::exists($picPath))
                    {
                        File::delete($picPath);
                    }
                    $picture->delete();
                }
            }
            return true;
        } catch (\Throwable $ex) {
            return false;
        }
    }
}
