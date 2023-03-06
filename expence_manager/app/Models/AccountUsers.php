<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'account_id',
    ];

    public function user()
    {
        return $this->hasOneThrough(User::class, Account::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_user_id');
    }
}
