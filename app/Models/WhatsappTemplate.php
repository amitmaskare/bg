<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappTemplate extends Model
{
    protected $fillable = [
        'template_id',
        'subject',
        'language',
        'body',
        'type',
    ];
}
