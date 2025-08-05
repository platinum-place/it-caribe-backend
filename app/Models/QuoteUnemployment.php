<?php

namespace App\Models;

use App\Enums\QuoteLineStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'quote_unemployment_debtor_type_id', 'quote_unemployment_use_type_id',
        'deadline', 'loan_installment',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function quoteUnemploymentDebtorType(): BelongsTo
    {
        return $this->belongsTo(QuoteUnemploymentDebtorType::class);
    }

    public function quoteUnemploymentUseType(): BelongsTo
    {
        return $this->belongsTo(QuoteUnemploymentUseType::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteUnemploymentLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteUnemploymentLine::class)
            ->whereHas('quoteLine', function ($query) {
                $query->where('quote_line_status_id', QuoteLineStatus::ACCEPTED->value);
            });
    }
}
