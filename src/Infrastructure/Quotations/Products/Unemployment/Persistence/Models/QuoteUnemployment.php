<?php

namespace Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Infrastructure\Organization\Locations\Persistence\Models\Branch;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Observers\QuoteUnemploymentObserver;

#[ObservedBy([QuoteUnemploymentObserver::class])]
class QuoteUnemployment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quote_id', 'branch_id', 'quote_unemployment_employment_type_id', 'quote_unemployment_employment_type_id',
        'deadline_month', 'deadline_year', 'loan_installment',
        'created_by', 'updated_by', 'deleted_by',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
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
