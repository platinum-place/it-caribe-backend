<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EstimateVehicle extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate-vehicle';

    public static function getNavigationLabel(): string
    {
        return __('Estimate :name', ['name' => __('Vehicle')]);
    }

    public function getHeading(): string
    {
        return __('Estimate :name', ['name' => __('Vehicle')]);
    }
}
