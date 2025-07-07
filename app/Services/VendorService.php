<?php

namespace App\Services;

use App\Contracts\Repositories\VendorRepositoryContract;
use App\Contracts\Services\VendorServiceContract;

class VendorService extends BaseService implements VendorServiceContract
{
    public function __construct(VendorRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
