<?php

namespace App\Enums\forlder;

enum Action: string
{
    case VIEW_ANY = 'view-any';

    case VIEW = 'view';

    case CREATE = 'create';

    case UPDATE = 'update';

    case DELETE = 'delete';

    case RESTORE = 'restore';

    case FORCE_DELETE = 'force-delete';

    public function getLabel(): string
    {
        return match ($this) {
            self::VIEW_ANY => __('View Any'),
            self::VIEW => __('View'),
            self::CREATE => __('Create'),
            self::UPDATE => __('Update'),
            self::DELETE => __('Delete'),
            self::RESTORE => __('Restore'),
            self::FORCE_DELETE => __('Force Delete'),
        };
    }
}
