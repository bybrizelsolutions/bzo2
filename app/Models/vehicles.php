<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class vehicles extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'registration',
        'make',
        'model',
        'purchase_date',
        'purchase_from',
        'service_by',
        'notes',
        'mileage'
    ];

    public function vehicleType()
    {
        return $this->belongsTo(vehicle_types::class, 'vehicle_type_id');
    }
}
