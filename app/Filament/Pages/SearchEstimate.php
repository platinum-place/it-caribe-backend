<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SearchEstimate /** extends Page */
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.search-estimate';

    public static function getNavigationLabel(): string
    {
        return __('Search :name', ['name' => __('Quote')]);
    }

    public function getHeading(): string
    {
        return __('Search :name', ['name' => __('Quote')]);
    }

    public static function getNavigationGroup(): string
    {
        return __('Search');
    }
}
