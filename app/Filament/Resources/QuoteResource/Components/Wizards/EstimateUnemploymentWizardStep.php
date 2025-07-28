<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Filament\Resources\QuoteResource\Components\Forms\EstimateFireForm;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateFireTable;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateUnemploymentForm;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateUnemploymentTable;
use Filament\Forms\Components\Wizard;
class EstimateUnemploymentWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Unemployment'))
            ->schema([
                EstimateUnemploymentForm::make(),
                EstimateUnemploymentTable::make(),
            ])
            ->columns();
    }
}
