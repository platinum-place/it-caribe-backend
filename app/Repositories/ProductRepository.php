<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
