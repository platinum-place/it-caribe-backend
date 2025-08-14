<?php

namespace App\Models\folder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Infrastructure\Persistance\Models\QuoteLine;

class QuoteUnemploymentLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_unemployment_id', 'quote_line_id', 'rate',
    ];

    public function quoteUnemployment(): BelongsTo
    {
        return $this->belongsTo(QuoteUnemployment::class);
    }

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class);
    }
}
