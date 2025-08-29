<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    'user_id',
    'product_id',
    'seller_id',
    'message',
    'status',
    'sender_type',
    'reply'
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function seller()
{
    return $this->belongsTo(\App\Models\Employee::class, 'seller_id');
}
public function product()
    {
        return $this->belongsTo(ListingProduct::class, 'product_id');
    }
public function sender() {
        return $this->sender_type === 'user' ? $this->user() : $this->seller();
    }

}
