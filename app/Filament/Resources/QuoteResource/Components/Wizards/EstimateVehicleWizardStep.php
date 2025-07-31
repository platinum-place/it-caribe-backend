<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Filament\Resources\QuoteResource\Components\Forms\EstimateVehicleForm;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateVehicleTable;
use Filament\Forms\Components\Wizard;

class EstimateVehicleWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Quote vehicle'))
            ->schema([
                EstimateVehicleForm::make(),
                EstimateVehicleTable::make(),
            ])
            ->columns();
    }
}
