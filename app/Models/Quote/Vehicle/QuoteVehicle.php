<?php

namespace App\Models\Quote\Vehicle;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Models\Quote\Quote;
use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_amount', 'vehicle_id',
        'is_employee', 'leasing', 'vehicle_loan_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function quoteVehicleLine(): HasMany
    {
        return $this->hasMany(QuoteVehicleLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteVehicleLine::class)
            ->whereHas('quoteLine', function ($query) {
                $query->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
            });
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
