<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'add_access',
        'edit_access',
        'view_access',
        'delete_access',
        'module_code',
        'permission_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
