<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'identity_number',
        'birth_date', 'home_phone',
        'mobile_phone', 'work_phone', 'email', 'address',
    ];
}
