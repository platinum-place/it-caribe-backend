<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_id', 'vehicle_make_id',
        'vehicle_model_id', 'vehicle_type_id', 'vehicle_use_id',
        'vehicle_activity_id', 'vehicle_amount',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vehicleMake(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class);
    }

    public function vehicleModel(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function vehicleUse(): BelongsTo
    {
        return $this->belongsTo(VehicleUse::class);
    }

    public function vehicleActivity(): BelongsTo
    {
        return $this->belongsTo(VehicleActivity::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteVehicleLine::class);
    }
}
