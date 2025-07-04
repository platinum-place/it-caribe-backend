<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository
{
    public function __construct(protected Model $model) {}

    public function search(array $params = [], ?bool $onlyTrashed = false): LengthAwarePaginator
    {
        $builder = $this->model->newQuery();

        foreach ($params as $field => $value) {
            $builder->where($field, $value);
        }

        if ($onlyTrashed) {
            $builder->onlyTrashed();
        }

        return $builder->paginate();
    }

    public function getById(int|string $id, ?array $relations = [], ?bool $onlyTrashed = false): Model
    {
        $builder = $this->model->newQuery();

        if (! empty($relations)) {
            $builder->with($relations);
        }

        if ($onlyTrashed) {
            $builder->onlyTrashed();
        }

        return $builder->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    public function update(int|string $id, array $data): Model
    {
        $model = $this->getById($id);

        $model->fill($data);
        $model->save();

        return $model;
    }

    public function destroy(int|string $id): void
    {
        $model = $this->getById($id);

        $model->delete();
    }

    public function restore(int|string $id): Model
    {
        $model = $this->getById($id, onlyTrashed: true);

        $model->restore();

        return $model;
    }
}
