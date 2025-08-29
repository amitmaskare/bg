<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
     protected $primaryKey = 'categoryId';
    protected $table = 'categories';

    protected $column_order = [null, 'cat.image', 'cat.categoryName', 'cat.status','cat.created_at', null];

    protected $column_search = ['cat.categoryName', 'cat.status'];

    protected $order = ['cat.categoryId' => 'DESC'];

    private function getDatatablesQuery($request)
    {
        $query = DB::table('categories as cat');

        if (!empty($request->input('search.value'))) {
            $searchValue = $request->input('search.value');
            $keywords = array_filter(explode(' ', $searchValue));

            $query->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $keyword = trim($keyword);
                    if (!empty($keyword)) {
                        $query->where(function ($q) use ($keyword) {
                            foreach ($this->column_search as $column) {
                                $q->orWhere($column, 'like', "%{$keyword}%");
                            }
                        });
                    }
                }
            });
        }

        // Ordering
        if ($request->has('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');

            if (isset($this->column_order[$orderColumnIndex]) && $this->column_order[$orderColumnIndex] !== null) {
                $query->orderBy($this->column_order[$orderColumnIndex], $orderDirection);
            }
            
        } else {
            $query->orderBy(key($this->order), current($this->order));
        }

        return $query;
    }

    public function getDatatables($request)
    {
        $query = $this->getDatatablesQuery($request);
        if ($request->input('length') != -1) {
            $query->skip($request->input('start'))->take($request->input('length'));
        }
        return $query->get();
    }

    public function countAll()
    {
        return DB::table($this->table)->count();
    }

    public function countFiltered($request)
    {
        return $this->getDatatablesQuery($request)->count();
    }
   
}
