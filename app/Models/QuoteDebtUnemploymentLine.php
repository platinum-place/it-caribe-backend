<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Infrastructure\Persistance\Models\QuoteLine;

class QuoteDebtUnemploymentLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_debt_unemployment_id', 'quote_line_id', 'rate',
        'rate2', 'total2', 'total1',
    ];

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class);
    }
}
