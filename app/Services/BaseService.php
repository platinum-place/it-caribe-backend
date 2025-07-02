<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseService
{
    public function __construct(protected BaseRepository $repository) {}

    public function search(array $params = [], ?bool $onlyTrashed = false): LengthAwarePaginator
    {
        return $this->repository->search($params, $onlyTrashed);
    }

    public function getById(int|string $id, ?array $relations = [], ?bool $onlyTrashed = false): Model
    {
        return $this->repository->getById($id, $relations, $onlyTrashed);
    }

    public function store(array $data): Model
    {
        return $this->repository->store($data);
    }

    public function update(int|string $id, array $data): Model
    {
        return $this->repository->update($id, $data);
    }

    public function destroy(int|string $id): void
    {
        $this->repository->destroy($id);
    }

    public function restore(int|string $id): Model
    {
        return $this->repository->restore($id);
    }
}
