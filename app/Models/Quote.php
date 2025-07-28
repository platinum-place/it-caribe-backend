<?php

namespace App\Models;

use App\Enums\QuoteLineStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'quote_type_id', 'quote_status_id', 'customer_id',
        'attachments', 'start_date', 'end_date', 'id_crm',
        'responsible_id',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
        ];
    }

    public function quoteFire(): HasOne
    {
        return $this->hasOne(QuoteFire::class);
    }

    public function quoteVehicle(): HasOne
    {
        return $this->hasOne(QuoteVehicle::class);
    }

    public function quoteLife(): HasOne
    {
        return $this->hasOne(QuoteLife::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(QuoteType::class, 'quote_type_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(QuoteStatus::class, 'quote_status_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteLine::class)->where('quote_line_status_id', QuoteLineStatus::ACCEPTED->value);
    }
}
