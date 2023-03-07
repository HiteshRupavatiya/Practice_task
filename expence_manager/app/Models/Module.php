<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'code',
        'name'
    ];

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class,'module_permissions');
    // }
}
