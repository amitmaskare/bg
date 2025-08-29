<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $primaryKey = 'blog_id';
    protected $table = 'blogs'; // Add this if your table is NOT `blogs`
    public $timestamps = true;

    protected $fillable = [
        'blog_id',
        'title',
        'image',
        'description',
    ];

    /**
     * Server-side DataTable query.
     */
    public function getDatatables($request)
    {
        $query = $this->newQuery();

        if ($request->has('search.value') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $orderCol = $request->input('order.0.column');
        $orderDir = $request->input('order.0.dir', 'desc');

        $columns = ['blog_id', 'title', 'description']; // Update to match table columns

        if (isset($columns[$orderCol])) {
            $query->orderBy($columns[$orderCol], $orderDir);
        } else {
            $query->orderBy('blog_id', 'desc');
        }

        if ($request->input('length') != -1) {
            $query->skip($request->input('start'))->take($request->input('length'));
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

        if ($request->has('search.value') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->count();
    }
}
