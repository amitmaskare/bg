<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_billing extends Model
{
    protected $table="order_billings";


    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'orderId');
    }

    public function listings()
    {
        return $this->belongsTo(ListingProduct::class);
    }
    
}
