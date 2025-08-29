<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'listing_id',
        'quantity',
        'shipping_charge',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function product()
{
    return $this->belongsTo(ListingProduct::class, 'listing_id');
}
}
