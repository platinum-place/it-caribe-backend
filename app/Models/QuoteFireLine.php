<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteFireLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_fire_id', 'quote_line_id', 'debtor_amount', 'fire_rate',
        'co_debtor_amount', 'debtor_rate', 'co_debtor_rate', 'fire_amount',
    ];

    public function quoteFire(): BelongsTo
    {
        return $this->belongsTo(QuoteFire::class);
    }

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class);
    }
}
