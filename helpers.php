<?php

if (! function_exists('combine_permissions')) {
    function combine_permissions(\App\Enums\Model|string $model, \App\Enums\Action|string $action): string
    {
        if (is_string($model)) {
            $model = App\Enums\Model::from($model);
        }

        if (is_string($action)) {
            $action = App\Enums\Action::from($action);
        }

        return "{$action->value} {$model->value}";
    }
}
