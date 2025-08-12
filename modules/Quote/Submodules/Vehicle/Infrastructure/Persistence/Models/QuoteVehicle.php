<?php

namespace Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id',  'vehicle_year', 'chassis', 'license_plate', 'vehicle_make_id', 'vehicle_year',
        'vehicle_model_id', 'vehicle_type_id', 'vehicle_use_id',
        'vehicle_activity_id', 'vehicle_amount', 'vehicle_rate',
        'vehicle_loan_type_id', 'is_employee', 'leasing', 'loan_amount', 'vehicle_utility_id',
    ];
}
