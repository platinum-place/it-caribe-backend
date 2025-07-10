<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
