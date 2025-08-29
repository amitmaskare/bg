<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses'; // Define the table name if it doesn't follow convention

    protected $fillable = [
        'user_id',
        'address_line',
        'city',
        'state',
        'postal_code',
        'country',
        'type',
    ];

    // Optional: define relationship to User if you have a User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
