<?php

namespace App\Models;

use App\Observers\VehicleModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([VehicleModelObserver::class])]
class VehicleModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'code', 'vehicle_make_id', 'vehicle_type_id', 'vehicle_utility_id',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function utility(): BelongsTo
    {
        return $this->belongsTo(VehicleUtility::class);
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
