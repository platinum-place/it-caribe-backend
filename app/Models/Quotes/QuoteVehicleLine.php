<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicleLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'quote_vehicle_id', 'unit_price',
        'quantity', 'subtotal', 'tax_rate','amount_taxed',
        'tax_amount', 'total', 'life_amount',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(QuoteVehicle::class);
    }
}
