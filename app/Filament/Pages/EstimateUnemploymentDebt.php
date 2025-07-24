<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EstimateUnemploymentDebt /** extends Page */
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate-unemployment-debt';

    public static function getNavigationLabel(): string
    {
        return __('Estimate :name', ['name' => __('UnemploymentDebt')]);
    }

    public function getHeading(): string
    {
        return __('Estimate :name', ['name' => __('UnemploymentDebt')]);
    }

    public static function getNavigationGroup(): string
    {
        return __('Estimate');
    }
}
