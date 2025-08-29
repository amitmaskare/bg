<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $primaryKey="role_id";
    protected $table="roles";
    public $timestamps=false;

    public function users(): BelongsToMany
    {
               return $this->belongsToMany(
            Employee::class,
            'employee_roles', // Assuming this is your pivot table
            'role_id',
            'employee_id'
        );
    }
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions', 
            'role_id',          
            'permission_id' 
        );
    }


 public function hasPermission($permission)
    {
        
        if (is_string($permission)) {
            return $this->permissions->contains('slug', $permission);
        }
        
        return $this->permissions->contains('permission_id', $permission->permission_id);
    }
}
