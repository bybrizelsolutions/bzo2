<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'category',
        'base_price_one',
        'size',
        'vehicle_type',
        'instructions',
        'service_type',
        'prd_ewc_code',
        'prd_component',
        'pence_flag',
        'full_weight',
        'empty_weight',
        'h2o',
        'cl',
        's',
        'solid',
        'fp',
        'ash',
        'vehicle_and_man_hire',
        'per_tonne_disposal',
        'service_check',
        'status',
        'prd_default_consignment_note_type',
        'prd_hazard_codes_id',
        'consignment_category_id',
        'prd_physical_form_id'
    ];
}
