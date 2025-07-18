<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use softDeletes;

    protected $fillable = [
        'identification', 'name',
    ];
}
