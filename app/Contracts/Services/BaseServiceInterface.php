<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseServiceInterface
{
    public function search(array $params = [], ?bool $onlyTrashed = false): LengthAwarePaginator;

    public function getById(int|string $id, ?array $relations = [], ?bool $onlyTrashed = false): Model;

    public function store(array $data): Model;

    public function update(int|string $id, array $data): Model;

    public function destroy(int|string $id): void;

    public function restore(int|string $id): Model;
}
