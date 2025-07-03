<?php

namespace App\Repositories\Partners;

use App\Contracts\Repositories\Partners\VendorRepositoryContract;
use App\Models\Partners\Vendor;
use App\Repositories\BaseRepository;

class VendorRepository extends BaseRepository implements VendorRepositoryContract
{
    public function __construct(Vendor $model)
    {
        parent::__construct($model);
    }
}
