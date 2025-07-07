<?php

namespace App\Services;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Contracts\Services\ProductServiceContract;

class ProductService extends BaseService implements ProductServiceContract
{
    public function __construct(ProductRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
