<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
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
