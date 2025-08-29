<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

abstract class BaseObserver
{
    public function creating(Model $model): void
    {
        $model->created_by = $this->getUserField();
    }

    public function updating(Model $model): void
    {
        $model->updated_by = $this->getUserField();
    }

    public function deleting(Model $model): void
    {
        $model->deleted_by = $this->getUserField();
    }

    private function getUserField(): int|string
    {
        return auth()->check() ? auth()->id() : config('app.admin_id');
    }
}
