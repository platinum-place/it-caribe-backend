<?php

namespace App\Models\Partners;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use softDeletes;

    protected $fillable = [
        'identification', 'name',
    ];
}
