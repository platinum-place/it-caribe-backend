<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function fullName():Attribute{
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}"
        );
    }
}
