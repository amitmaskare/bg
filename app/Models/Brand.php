<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'brandId';
    public $timestamps = true;
    protected $fillable = [
        'brand_name',
        'status',
    ];

    public function getDatatables($request)
    {
        $query = $this->newQuery();

        if ($request->has('search') && $request->input('search')['value'] != '') {
            $search = $request->input('search')['value'];
            $query->where(function($q) use ($search) {
                $q->where('brand_name', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }       
    public function countAll()
    {
        return $this->count();
    }
    public function countFiltered($request)
    {
        $query = $this->newQuery(); 
        if ($request->has('search') && $request->input('search')['value'] != '') {
            $search = $request->input('search')['value'];
            $query->where(function($q) use ($search) {
                $q->where('brand_name', 'like', "%{$search}%");
            });
        }  
        return $query->count();
    }     
}
