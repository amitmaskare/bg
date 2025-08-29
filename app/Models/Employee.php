<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Employee extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'id';
    protected $table = 'employees';

    protected $fillable = ['name', 'email', 'password','role_id', 'profile', 'address', 'adhaar_numer', 'phone', 'emerg_phone', 'postal_code', 'country'];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'employee_roles', 
            'employee_id',    
            'role_id',
        );
    }
    // public function Haspermission($permission)
    // {
    //     return $this->role->permissions()->where('name', $permission)->exists();
    // }
    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }
    public function hasAnyPermission($permissions)
    {
        return $this->role->permissions()->whereIn('name', $permissions)->exists();
    }
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }
    public function hasAnyRole($roles)
    {
        return $this->role->whereIn('name', $roles)->exists();
    }
    public function getProfileUrlAttribute()
    {
        return asset($this->profile);
    }
 
}
