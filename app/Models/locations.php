<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'consignment_note_required',
        'permit_number',
        'website',
        'area_id',
        'country_id',
        'address_id'
    ];

    public function area()
    {
        return $this->belongsTo(area::class, 'area_id');
    }

    public function country()
    {
        return $this->belongsTo(countries::class, 'country_id');
    }

    public function address()
    {
        return $this->belongsTo(addresses::class, 'address_id');
    }
}
