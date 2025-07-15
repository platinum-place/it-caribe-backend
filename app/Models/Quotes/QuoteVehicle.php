<?php

namespace App\Models\Quotes;

use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\VehicleAccessory;
use App\Models\Vehicles\VehicleActivity;
use App\Models\Vehicles\VehicleColor;
use App\Models\Vehicles\VehicleMake;
use App\Models\Vehicles\VehicleModel;
use App\Models\Vehicles\VehicleRoute;
use App\Models\Vehicles\VehicleType;
use App\Models\Vehicles\VehicleUse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_id', 'vehicle_make_id', 'vehicle_year',
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

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(VehicleAccessory::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(VehicleColor::class);
    }

    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(VehicleRoute::class);
    }
}
