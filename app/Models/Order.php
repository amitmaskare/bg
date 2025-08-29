<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'buyerId');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class,'shipping_address_id');
    }

    
   
}
