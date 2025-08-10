<?php

namespace Modules\Quote\Infrastructure\Persistance\Models;

use App\Models\QuoteDebtUnemployment;
use App\Models\QuoteFire;
use App\Models\QuoteLife;
use App\Models\QuoteUnemployment;
use App\Models\QuoteVehicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Quote\Domain\Enums\QuoteLineStatusEnum;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'quote_type_id', 'quote_status_id', 'debtor_id',
        'attachments', 'start_date', 'end_date', 'id_crm',
        'responsible_id', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
        ];
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

    public function quoteUnemployment(): HasOne
    {
        return $this->hasOne(QuoteUnemployment::class);
    }

    public function quoteDebtUnemployment(): HasOne
    {
        return $this->hasOne(QuoteDebtUnemployment::class);
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

    public function debtor(): BelongsTo
    {
        return $this->belongsTo(Debtor::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(QuoteLine::class);
    }

    public function selectedLine(): HasOne
    {
        return $this->hasOne(QuoteLine::class)->where('quote_line_status_id', QuoteLineStatusEnum::ACCEPTED->value);
    }
}
