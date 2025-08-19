<?php

if (! function_exists('combine_permissions')) {
    function combine_permissions(\App\Enums\forlder\Model|string $model, \App\Enums\forlder\Action|string $action): string
    {
        if (is_string($model)) {
            $model = \App\Enums\forlder\Model::from($model);
        }

        if (is_string($action)) {
            $action = \App\Enums\forlder\Action::from($action);
        }

        return "{$action->value} {$model->value}";
    }
}
