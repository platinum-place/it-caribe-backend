<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleRoute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name',
    ];

    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(QuoteVehicle::class);
    }
}
