<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StockLocation extends Model
{
    use HasFactory;
  //  protected $primaryKey = 'sellerID';
    protected $table = 'stocklocations';
    protected $fillable = [
        'sellerID',
        'name',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'direction',
        'contactInformation',
    ];

    // public function seller()
    // {
    //     return $this->belongsTo(User::class, 'seller_id');
    // }
    public function getDatatables($request)
    {
        $query = $this->newQuery();

        if ($request->has('search') && $request->input('search')['value'] != '') {
            $search = $request->input('search')['value'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('postal_code', 'like', "%{$search}%");
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
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('postal_code', 'like', "%{$search}%");
            }); 
           
          }
       return $query->count();
}
}
