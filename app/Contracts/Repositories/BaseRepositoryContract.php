<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryContract
{
    public function search(array $params = [], ?bool $onlyTrashed = false): LengthAwarePaginator;

    public function getById(int|string $id, ?array $relations = [], ?bool $onlyTrashed = false): Model;

    public function store(array $data): Model;

    public function update(int|string $id, array $data): Model;

    public function destroy(int|string $id): void;

    public function restore(int|string $id): Model;
}
