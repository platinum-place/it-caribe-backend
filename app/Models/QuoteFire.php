<?php

namespace App\Models;

use App\Observers\QuoteFireObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([QuoteFireObserver::class])]
class QuoteFire extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'quote_fire_credit_type_id', 'quote_fire_risk_type_id',
        'quote_fire_construction_type_id', 'co_borrower_id', 'guarantor',
        'deadline_month', 'deadline_year', 'appraisal_value', 'financed_value', 'property_address',
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
