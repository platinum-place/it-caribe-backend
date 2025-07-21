<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicleLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_vehicle_id', 'quote_line_id', 'life_amount',
    ];

    public function quoteVehicle(): BelongsTo
    {
        return $this->belongsTo(QuoteVehicle::class);
    }

    public function quoteLine(): BelongsTo
    {
        return $this->belongsTo(QuoteLine::class);
    }
}
