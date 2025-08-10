<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Infrastructure\Persistance\Models\QuoteLine;

class QuoteLifeLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_life_id', 'quote_line_id', 'debtor_amount',
        'co_debtor_amount', 'debtor_rate', 'co_debtor_rate',
    ];

    public function quoteLife(): BelongsTo
    {
        return $this->belongsTo(QuoteLife::class);
    }

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class);
    }
}
