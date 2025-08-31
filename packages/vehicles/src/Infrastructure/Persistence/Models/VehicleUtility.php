<?php

namespace Root\Vehicles\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Root\Vehicles\Infrastructure\Persistence\Models\Vehicle;
use Root\Vehicles\Infrastructure\Persistence\Observers\VehicleUtilityObserver;

#[ObservedBy([VehicleUtilityObserver::class])]
class VehicleUtility extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }
}
