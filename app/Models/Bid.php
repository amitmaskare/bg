<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'bidId'; // custom primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'listingId',
        'bidderId',
        'amount',
        'quantity',
        'status',
        'bid_time',
        'counter_offer_amount',
        'counter_offer_reason',
        'rejection_reason'
    ];

    protected $dates = ['bid_time', 'created_at', 'updated_at', 'deleted_at'];
}
?>
