<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; 
    protected $primaryKey = 'productId';  
    public $timestamps = false; 
    
    public function image()
    {
        return $this->hasMany(ProductImage::class, 'productId', 'productId');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategoryId', 'subcategoryId');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId', 'brandId');
    }
    public function additionalFields()
    {
        return $this->hasMany(ProductAdditionalField::class, 'productId', 'productId');
    }
    public function stockLocations()
    {
        return $this->hasMany(ProductStockLocation::class, 'productId', 'productId');
    }
  public function getDatatables($request)
{
    $query = $this->newQuery()
        ->join('categories as cat', 'products.categoryId', '=', 'cat.categoryId')
        ->join('subcategories as subcat', 'products.subcategoryId', '=', 'subcat.subcategoryId')
        ->select('products.*', 'cat.categoryName', 'subcat.name as subcategory');

    if ($request->has('search') && $request->input('search')['value'] != '') {
        $search = $request->input('search')['value'];
        $query->where(function($q) use ($search) {
            $q->where('products.name', 'LIKE', "%{$search}%")
              ->orWhere('cat.categoryName', 'LIKE', "%{$search}%")
              ->orWhere('subcat.name', 'LIKE', "%{$search}%");
        });
    }

    return $query->get();
}

public function countAll()
{
    return $this->count();
}

public function countFiltered($request)
{
    $query = $this->newQuery()
        ->join('categories as cat', 'products.categoryId', '=', 'cat.categoryId')
        ->join('subcategories as subcat', 'products.subcategoryId', '=', 'subcat.subcategoryId');

    if ($request->has('search') && $request->input('search')['value'] != '') {
        $search = $request->input('search')['value'];
        $query->where(function($q) use ($search) {
            $q->where('products.name', 'LIKE', "%{$search}%")
              ->orWhere('cat.categoryName', 'LIKE', "%{$search}%")
              ->orWhere('subcat.name', 'LIKE', "%{$search}%");
        });
    }

    return $query->count();
}

}
