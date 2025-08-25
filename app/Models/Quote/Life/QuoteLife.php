<?php

namespace App\Models\Quote\Life;

use App\Models\Quote\Quote;
use App\Observers\Quote\Life\QuoteLifeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([QuoteLifeObserver::class])]
class QuoteLife extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'co_borrower_id', 'quote_life_credit_type_id',
        'deadline_month', 'deadline_year', 'guarantor', 'insured_amount',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLifeLine::class);
    }

    public function acceptedLine(): HasOne
    {
        return $this->hasOne(QuoteLifeLine::class)->acceptedLine();
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
}
