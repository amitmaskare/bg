<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'banner_id';
    public $timestamps = true;
    protected $fillable = ['banner_id','banner_image', 'status'];

    public function getDatatables($request)
    {
        $query = $this->newQuery();
        
        if ($request->has('search') && $request->input('search')['value'] != '') {
            $search = $request->input('search')['value'];
            $query->where(function($q) use ($search) {
                $q->where('banner_image', 'like', "%{$search}%");
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
                $q->where('banner_image', 'like', "%{$search}%");
            });
        }

        return $query->count();
    }

}


?>