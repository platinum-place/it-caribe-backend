<?php

namespace App\Models\Vehicle;

use App\Models\Quote\Vehicle\QuoteVehicle;
use App\Observers\Vehicle\VehicleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([VehicleObserver::class])]
class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'created_by', 'updated_by', 'deleted_by',
        'vehicle_year', 'chassis', 'license_plate', 'vehicle_make_id',
        'vehicle_model_id', 'vehicle_type_id', 'vehicle_use_id',
        'vehicle_activity_id',  'vehicle_loan_type_id', 'vehicle_utility_id',
    ];

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

    public function vehicleMake(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id');
    }

    public function vehicleModel(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function vehicleUse(): BelongsTo
    {
        return $this->belongsTo(VehicleUse::class, 'vehicle_use_id');
    }

    public function vehicleActivity(): BelongsTo
    {
        return $this->belongsTo(VehicleActivity::class, 'vehicle_activity_id');
    }

    public function vehicleLoanType(): BelongsTo
    {
        return $this->belongsTo(VehicleLoanType::class, 'vehicle_loan_type_id');
    }

    public function vehicleUtility(): BelongsTo
    {
        return $this->belongsTo(VehicleUtility::class, 'vehicle_utility_id');
    }

    public function vehicleColors(): BelongsToMany
    {
        return $this->belongsToMany(VehicleColor::class, 'vehicle_vehicle_color');
    }

    public function vehicleRoutes(): BelongsToMany
    {
        return $this->belongsToMany(VehicleRoute::class, 'vehicle_vehicle_route');
    }

    public function vehicleAccessories(): BelongsToMany
    {
        return $this->belongsToMany(VehicleAccessory::class, 'vehicle_vehicle_accessory');
    }

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(QuoteVehicle::class);
    }
}
