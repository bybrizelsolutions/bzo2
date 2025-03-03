<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class vehicle_types extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
    ];
}
