<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'birth_date', 'home_phone',
        'mobile_phone', 'work_phone', 'email',
    ];
}
