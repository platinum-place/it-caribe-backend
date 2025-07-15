<?php

namespace App\Models\Quotes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name',
    ];
}
