<?php

namespace App\Models\Quote\Vehicle;

use App\Models\Quote\QuoteLine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicleLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_vehicle_id', 'quote_line_id', 'life_amount', 'vehicle_rate', 'total_monthly',
        'latest_expenses', 'markup', 'amount_without_life_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function quoteVehicle(): BelongsTo
    {
        return $this->belongsTo(QuoteVehicle::class, 'quote_vehicle_id');
    }

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class, 'quote_vehicle_id');
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
