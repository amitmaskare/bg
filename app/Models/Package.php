<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $primaryKey="packageId";
    protected $table="packages";
    public $timestamps=false;
}
