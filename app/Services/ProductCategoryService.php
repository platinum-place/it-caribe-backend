<?php

namespace App\Services;

use App\Contracts\Repositories\ProductCategoryRepositoryContract;
use App\Contracts\Services\ProductCategoryServiceContract;

class ProductCategoryService extends BaseService implements ProductCategoryServiceContract
{
    public function __construct(ProductCategoryRepositoryContract $repository)
    {
        parent::__construct($repository);
    }
}
