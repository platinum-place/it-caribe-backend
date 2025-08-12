<?php

namespace Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicleLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_vehicle_id', 'quote_line_id', 'life_amount', 'latest_expenses', 'markup',
    ];
}
