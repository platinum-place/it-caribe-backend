<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class EditPermissions extends Page
{
    use InteractsWithRecord;

    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.edit-permissions';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getTitle(): string|Htmlable
    {
        return __('Edit permissions');
    }
}
