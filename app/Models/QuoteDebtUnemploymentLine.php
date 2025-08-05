<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteDebtUnemploymentLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_debt_unemployment_id', 'quote_line_id', 'rate',
    ];
}
