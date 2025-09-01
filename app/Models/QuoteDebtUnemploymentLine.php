<?php

namespace App\Models;

use App\Observers\QuoteDebtUnemploymentLineObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
