<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Domain\Enums\QuoteLineStatusEnum;
use Modules\Quote\Infrastructure\Persistance\Models\Debtor;
use Modules\Quote\Infrastructure\Persistance\Models\Quote;

class QuoteFire extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'quote_fire_credit_type_id', 'quote_fire_risk_type_id',
        'quote_fire_construction_type_id', 'co_debtor_id', 'guarantor',
        'deadline', 'appraisal_value', 'financed_value', 'property_address',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function quoteFireCreditType(): BelongsTo
    {
        return $this->belongsTo(QuoteFireCreditType::class);
    }

    public function coDebtor(): BelongsTo
    {
        return $this->belongsTo(Debtor::class, 'co_debtor_id');
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
        return $this->hasMany(QuoteFireLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteFireLine::class)
            ->whereHas('quoteLine', function ($query) {
                $query->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
            });
    }
}
