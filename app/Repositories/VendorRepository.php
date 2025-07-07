<?php

namespace App\Repositories;

use App\Contracts\Repositories\VendorRepositoryContract;
use App\Models\Vendor;

class VendorRepository extends BaseRepository implements VendorRepositoryContract
{
    public function __construct(Vendor $model)
    {
        parent::__construct($model);
    }
}
