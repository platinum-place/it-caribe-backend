<?php

if (! function_exists('combine_permissions')) {
    function combine_permissions(\app\Enums\forlder\Model|string $model, \app\Enums\forlder\Action|string $action): string
    {
        if (is_string($model)) {
            $model = \app\Enums\forlder\Model::from($model);
        }

        if (is_string($action)) {
            $action = \app\Enums\forlder\Action::from($action);
        }

        return "{$action->value} {$model->value}";
    }
}
