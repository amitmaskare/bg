<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
class ListingProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'sellerId',
        'productId',
        'product_name',
        'categoryId',
        'subcategoryId',
        'type',
        'quantity',
        'mrp',
        'price',
        'discount',
        'offer',
       // 'currencyId',
       
        'status',
        'description',
        'main_image',
        'other_image',
        'slug_url',
        'additional_fields',
        'sale_type',
        'quality',
        'estimated_purchasedate',
        'item_condition',
        'stock_location_id',
        'shipping_include',
        'kilometer',
        'feature_product'
        
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'productId')
            ->select('productId', 'name');
    }
public function reviews()
{
    return $this->hasMany(Review::class, 'product_id', 'id'); // adjust foreign/local keys if needed
}
}
