<?php

namespace App\Models;

use App\Observers\QuoteDebtUnemploymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([QuoteDebtUnemploymentObserver::class])]
class QuoteDebtUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'branch_id', 'deadline_month', 'deadline_year', 'vehicle_amount',
        'loan_amount', 'insured_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
