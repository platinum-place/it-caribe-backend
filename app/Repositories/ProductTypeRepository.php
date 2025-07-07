<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductTypeRepositoryContract;
use App\Models\ProductType;

class ProductTypeRepository extends BaseRepository implements ProductTypeRepositoryContract
{
    public function __construct(ProductType $model)
    {
        parent::__construct($model);
    }
}
