<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function role_permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }
}
