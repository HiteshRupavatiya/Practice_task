<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'code',
        'name',
        'is_active'
    ];

    public function permissions(){
        return $this->hasMany(ModulePermission::class);
    }
   
}
