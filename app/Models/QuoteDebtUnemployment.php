<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteDebtUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'vehicle_id', 'vehicle_make_id', 'vehicle_year',
        'vehicle_model_id', 'vehicle_type_id', 'vehicle_use_id',
        'vehicle_activity_id', 'vehicle_amount','vehicle_loan_type_id','loan_amount',
        'insured_amount',
    ];
}
