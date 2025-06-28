<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SearchEmit extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.search-emit';

    public static function getNavigationLabel(): string
    {
        return __('Buscar Emisiones');
    }

    public function getHeading(): string
    {
        return __('Buscar Emisiones');
    }

    public static function getNavigationGroup(): string
    {
        return __('Search');
    }
}
