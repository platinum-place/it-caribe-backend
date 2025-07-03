<?php

namespace App\Services\Partners;

use App\Contracts\Repositories\Partners\VendorRepositoryContract;
use App\Contracts\Services\Partners\VendorServiceContract;
use App\Services\BaseService;

class VendorService extends BaseService implements VendorServiceContract
{
    public function __construct(VendorRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
