<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EstimateVehicleLaw extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.estimate-vehicle-law';

    public static function getNavigationLabel(): string
    {
        return __('Estimate :name', ['name' => __('VehicleLaw')]);
    }

    public function getHeading(): string
    {
        return __('Estimate :name', ['name' => __('VehicleLaw')]);
    }

    public static function getNavigationGroup(): string
    {
        return __('Estimate');
    }
}
