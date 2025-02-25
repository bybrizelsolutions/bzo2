<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class addresses extends Model
{
    protected $fillable = [
        'address_line_one',
        'address_line_two',
        'town',
        'country',
        'postcode'
    ];
}
