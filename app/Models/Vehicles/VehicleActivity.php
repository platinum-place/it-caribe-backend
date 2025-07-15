<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleActivity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name',
    ];
}
