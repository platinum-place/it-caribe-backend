<?php

if (! function_exists('number_to_uuid')) {
    function number_to_uuid(int|string $number): string
    {
        $hex = str_pad(dechex($number), 32, '0', STR_PAD_LEFT);

        return substr($hex, 0, 8).'-'.
            substr($hex, 8, 4).'-'.
            substr($hex, 12, 4).'-'.
            substr($hex, 16, 4).'-'.
            substr($hex, 20);
    }
}

if (! function_exists('uuid_to_number')) {
    function uuid_to_number(string $uuid): float|int
    {
        $hex = str_replace('-', '', $uuid);

        return hexdec(ltrim($hex, '0'));
    }
}

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
