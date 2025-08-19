<?php

namespace App\Models\folder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteUnemploymentUseType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name',
    ];
}
