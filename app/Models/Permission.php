<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    protected $primaryKey = "permission_id";
    protected $table = "permissions";
    public $timestamps = false;

    protected $column_order = [null, 'p.name', 'p.status', 'p.created_at', null];
    protected $column_search = ['p.name', 'p.status'];
    protected $order = ['p.permission_id' => 'DESC'];

    private function getDatatablesQuery($request)
    {
        $query = DB::table('permissions as p')
            ->select('p.permission_id', 'p.name', 'p.status', 'p.created_at');

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

