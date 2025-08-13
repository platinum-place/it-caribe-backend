<?php

namespace Modules\Vehicle\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models\QuoteVehicle;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'created_by', 'updated_by', 'deleted_by',
       'vehicle_year', 'chassis', 'license_plate', 'vehicle_make_id', 'vehicle_year',
        'vehicle_model_id', 'vehicle_type_id', 'vehicle_use_id',
        'vehicle_activity_id',  'vehicle_loan_type_id','vehicle_utility_id',
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

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(QuoteVehicle::class);
    }
}
