<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;

class Emit extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.emit';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getSlug(): string
    {
        return 'emit/{id}';
    }

    public ?int $id = 0;

    public function mount(int $id): void
    {
        $this->id = $id;
    }

    public static function getNavigationLabel(): string
    {
        return __('Emit');
    }

    public function getHeading(): string
    {
        return __('Emit');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download')
                ->translateLabel()
                ->url(route('filament.resources.estimate.download', ['id' => $this->id]))
                ->openUrlInNewTab(),
        ];
    }
}
