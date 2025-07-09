<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_type_id', 'quote_status_id', 'customer_id',
        'attachments', 'start_date', 'end_date',
    ];
}
