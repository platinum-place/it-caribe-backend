<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\QuoteFireLineObserver;

#[ObservedBy([QuoteFireLineObserver::class])]
class QuoteFireLine extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_fire_id', 'quote_line_id', 'borrower_amount', 'fire_rate',
        'co_borrower_amount', 'borrower_rate', 'co_borrower_rate', 'fire_amount', 'life_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

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
}
