<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EstimateLife /** extends Page */
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate-life';

    public static function getNavigationLabel(): string
    {
        return __('Estimate :name', ['name' => __('Life')]);
    }

    public function getHeading(): string
    {
        return __('Estimate :name', ['name' => __('Life')]);
    }

    public static function getNavigationGroup(): string
    {
        return __('Estimate');
    }
}
