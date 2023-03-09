<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'role_name',
        'description',
        'is_active'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function role_permissions(){
        return $this->hasMany(RolePermission::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

}
