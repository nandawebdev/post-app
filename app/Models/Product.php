<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'sku',
        'product_name',
        'purchase_price',
        'product_purchase_price',
        'stock',
        'minimum_stock',
        'is_active',
        'category_id',
    ];

    public static function generateSku()
    {
        //SKU-00001
        $prefix = 'SKU-';
        $maxId = self::max('id');
        $sku = $prefix . str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);
        return $sku;
    }
}
