<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_name',
    ];

    public function modulePermissions()
    {
        return $this->hasMany(ModulePermission::class);
    }

    public function modules()
    {
        return $this->hasOneThrough(ModulePermission::class, Module::class);
    }
}
