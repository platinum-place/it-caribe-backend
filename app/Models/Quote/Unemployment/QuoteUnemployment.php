<?php

namespace App\Models\Quote\Unemployment;

use App\Models\Location\Branch;
use App\Models\Quote\Quote;
use App\Observers\Quote\Unemployment\QuoteUnemploymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([QuoteUnemploymentObserver::class])]
class QuoteUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'quote_unemployment_employment_type_id', 'quote_unemployment_employment_type_id',
        'deadline_month', 'deadline_year', 'loan_installment',
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
