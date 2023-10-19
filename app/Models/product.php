<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'title',
        'description',
        'size',
        'price',
        'promotional_price',
    ];

    public function pictures(): HasMany
    {
        return $this->hasMany(picture::class)->select(['id', 'path', 'product_id']);
    }
}
