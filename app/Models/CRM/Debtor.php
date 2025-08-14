<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debtor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_name', 'first_name', 'last_name', 'identity_number', 'age',
        'birth_date', 'home_phone', 'mobile_phone', 'work_phone', 'email', 'address',
        'debtor_type_id', 'created_by', 'updated_by', 'deleted_by',
    ];

    public function debtorType(): BelongsTo
    {
        return $this->belongsTo(DebtorType::class, 'debtor_type_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(DebtorType::class);
    }
}
