<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states';
    protected $primaryKey = 'stateID'; // <== This fixes the issue
    public $timestamps = false;

    protected $fillable = ['stateName', 'countryID'];
    
    public function cities()
    {
        return $this->hasMany(City::class, 'stateID');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryID');
    }
}


?>