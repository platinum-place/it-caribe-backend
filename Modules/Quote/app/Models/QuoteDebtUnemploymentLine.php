<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Observers\QuoteDebtUnemploymentLineObserver;

#[ObservedBy([QuoteDebtUnemploymentLineObserver::class])]
class QuoteDebtUnemploymentLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_debt_unemployment_id', 'quote_line_id', 'debt_rate', 'unemployment_rate',
        'debt_amount', 'unemployment_amount',
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
