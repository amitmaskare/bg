<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries'; // optional if table name matches Laravel's convention
    public $timestamps = false;

    protected $fillable = ['countryName'];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}







?>