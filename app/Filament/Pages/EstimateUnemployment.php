<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EstimateUnemployment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate-unemployment';

    public static function getNavigationLabel(): string
    {
        return __('Estimate :name', ['name' => __('Unemployment')]);
    }

    public function getHeading(): string
    {
        return __('Estimate :name', ['name' => __('Unemployment')]);
    }

    public static function getNavigationGroup(): string
    {
        return __('Estimate');
    }
}
