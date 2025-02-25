<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
