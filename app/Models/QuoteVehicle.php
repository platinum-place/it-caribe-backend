<?php

namespace App\Models;

use App\Observers\QuoteVehicleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([QuoteVehicleObserver::class])]
class QuoteVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_amount', 'vehicle_id',
        'is_employee', 'leasing', 'vehicle_loan_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function branch(): HasOneThrough
    {
        return $this->hasOneThrough(Branch::class, Quote::class, 'id', 'id', 'quote_id', 'branch_id');
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteVehicleLine::class);
    }

    public function acceptedLine(): HasOne
    {
        return $this->hasOne(QuoteVehicleLine::class)->whereHas('quoteLine', fn ($q) => $q->accepted());
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
