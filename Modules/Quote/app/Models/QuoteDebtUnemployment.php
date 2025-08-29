<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Location\Models\Branch;
use Modules\Quote\Observers\QuoteDebtUnemploymentObserver;

#[ObservedBy([QuoteDebtUnemploymentObserver::class])]
class QuoteDebtUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'deadline_month', 'deadline_year', 'vehicle_amount',
        'loan_amount', 'insured_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function branch(): HasOneThrough
    {
        return $this->hasOneThrough(Branch::class, Quote::class, 'id', 'id', 'quote_id', 'branch_id');
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
