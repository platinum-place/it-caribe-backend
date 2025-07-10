<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'quote_id', 'unit_price',
        'quantity', 'subtotal', 'tax_rate',
        'tax_amount', 'total',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
