<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteLife extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'co_debtor_id', 'quote_credit_type_id',
        'deadline', 'guarantor', 'insured_amount',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }

    public function quoteCreditType(): BelongsTo
    {
        return $this->belongsTo(QuoteCreditType::class);
    }

    public function coDebtor(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'co_debtor_id');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLifeLine::class);
    }
}
