<?php

namespace App\Models\folder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Enums\QuoteLineStatusEnum;
use Modules\Quote\Infrastructure\Persistance\Models\Debtor;
use Modules\Quote\Infrastructure\Persistance\Models\Quote;

class QuoteLife extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'co_debtor_id', 'quote_life_credit_type_id',
        'deadline', 'guarantor', 'insured_amount',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function quoteLifeCreditType(): BelongsTo
    {
        return $this->belongsTo(QuoteLifeCreditType::class);
    }

    public function coDebtor(): BelongsTo
    {
        return $this->belongsTo(Debtor::class, 'co_debtor_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLifeLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteLifeLine::class)
            ->whereHas('quoteLine', function ($query) {
                $query->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
            });
    }
}
