<?php

namespace App\Models\Insurance;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TmpQuote extends Model
{
    use HasUuids;

    protected $fillable = [
        'id_crm',
    ];
}
