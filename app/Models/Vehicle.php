<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'year', 'chassis', 'license_plate', 'vehicle_color_id',
        'vehicle_make_id', 'vehicle_model_id', 'vehicle_type_id',
    ];
}
