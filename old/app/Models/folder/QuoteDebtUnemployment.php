<?php

namespace App\Models\folder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Enums\QuoteLineStatusEnum;
use Modules\Quote\Infrastructure\Persistance\Models\Quote;

class QuoteDebtUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_id', 'vehicle_make_id', 'vehicle_year',
        'vehicle_model_id', 'vehicle_type_id', 'vehicle_use_id',
        'vehicle_activity_id', 'vehicle_amount', 'vehicle_loan_type_id', 'loan_amount',
        'insured_amount', 'quote_unemployment_use_type_id', 'deadline',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteDebtUnemploymentLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteDebtUnemploymentLine::class)
            ->whereHas('quoteLine', function ($query) {
                $query->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
            });
    }

    public function quoteUnemploymentUseType(): BelongsTo
    {
        return $this->belongsTo(QuoteUnemploymentUseType::class);
    }
}
