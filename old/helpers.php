<?php

if (! function_exists('combine_permissions')) {
    function combine_permissions(\App\forlder\Model|string $model, \App\forlder\Action|string $action): string
    {
        if (is_string($model)) {
            $model = \App\forlder\Model::from($model);
        }

        if (is_string($action)) {
            $action = \App\forlder\Action::from($action);
        }

        return "{$action->value} {$model->value}";
    }
}
