<?php

namespace App\Models;

use App\Enums\QuoteLineStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteFire extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'quote_credit_type_id', 'quote_fire_risk_type_id',
        'quote_fire_construction_type_id', 'co_debtor_id', 'guarantor',
        'deadline', 'property_value', 'loan_value', 'property_address',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function quoteCreditType(): BelongsTo
    {
        return $this->belongsTo(QuoteCreditType::class);
    }

    public function coDebtor(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'co_debtor_id');
    }

    public function quoteFireRiskType(): BelongsTo
    {
        return $this->belongsTo(QuoteFireRiskType::class);
    }

    public function quoteFireConstructionType(): BelongsTo
    {
        return $this->belongsTo(QuoteFireConstructionType::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLifeLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteLifeLine::class)
            ->whereHas('quoteLine', function ($query) {
                $query->where('quote_line_status_id', QuoteLineStatus::ACCEPTED->value);
            });
    }
}
