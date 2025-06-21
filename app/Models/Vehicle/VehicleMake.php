<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleMake extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }
}
