<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductCategoryRepositoryContract;
use App\Models\ProductCategory;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryContract
{
    public function __construct(ProductCategory $model)
    {
        parent::__construct($model);
    }
}
