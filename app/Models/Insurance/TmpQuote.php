<?php

namespace App\Models\Insurance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TmpQuote extends Model
{
    use HasUuids;

    protected $fillable = [
        'id_crm',
    ];
}
