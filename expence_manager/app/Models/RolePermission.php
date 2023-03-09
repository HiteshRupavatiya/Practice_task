<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;


    protected $fillable = [
        'add_access',
        'edit_access',
        'view_access',
        'delete_access',
        'role_id',
        'permission_id'
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
