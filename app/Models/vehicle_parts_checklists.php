<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle_parts_checklists extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_name',
        'vehicle_type_id',
        'notes',
        'status'
    ];

    public function vehicleType()
    {
        return $this->belongsTo(vehicle_types::class, 'vehicle_type_id');
    }
}
