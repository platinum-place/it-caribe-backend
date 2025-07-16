<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','description', 'quote_id', 'unit_price', 'id_crm',
        'quantity', 'subtotal', 'tax_rate',
        'tax_amount', 'total', 'amount_taxed', 'quote_line_status_id',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(QuoteLineStatus::class);
    }
}
