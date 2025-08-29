<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
     protected $primaryKey="id ";
    protected $table="role_permissions";
    public $timestamps=false;


    public function role()
    {
        return $this->belongsTo(Role::class,'role_id', 'role_id');
    }
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }


}
