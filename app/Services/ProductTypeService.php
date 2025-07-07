<?php

namespace App\Services;

use App\Contracts\Repositories\ProductTypeRepositoryContract;
use App\Contracts\Services\ProductTypeServiceContract;

class ProductTypeService extends BaseService implements ProductTypeServiceContract
{
    public function __construct(ProductTypeRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
