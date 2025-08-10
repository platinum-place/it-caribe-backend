<?php

namespace Modules\Vehicle\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'name', 'code', 'vehicle_make_id', 'vehicle_type_id', 'vehicle_utility_id',
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function utility(): BelongsTo
    {
        return $this->belongsTo(VehicleUtility::class, 'vehicle_utility_id');
    }
}
