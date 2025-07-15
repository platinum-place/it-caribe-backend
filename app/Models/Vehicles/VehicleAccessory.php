<?php

namespace App\Models\Vehicles;

use App\Models\Quotes\QuoteVehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleAccessory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name',
    ];

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(QuoteVehicle::class);
    }
}
