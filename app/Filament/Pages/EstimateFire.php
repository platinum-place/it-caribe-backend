<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EstimateFire /** extends Page */
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate-fire';

    public static function getNavigationLabel(): string
    {
        return __('Estimate :name', ['name' => __('Fire')]);
    }

    public function getHeading(): string
    {
        return __('Estimate :name', ['name' => __('Fire')]);
    }

    public static function getNavigationGroup(): string
    {
        return __('Estimate');
    }
}
