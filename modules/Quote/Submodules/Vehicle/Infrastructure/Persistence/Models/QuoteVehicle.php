<?php

namespace Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_amount', 'vehicle_rate','vehicle_id',
        'is_employee', 'leasing','vehicle_loan_amount',
        'created_by', 'updated_by', 'deleted_by',
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
}
