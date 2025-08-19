<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Filament\Resources\QuoteResource\Components\Forms\EstimateDebtUnemploymentForm;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateDebtUnemploymentTable;
use Filament\Forms\Components\Wizard;

class EstimateDebtUnemploymentWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('UnemploymentDebt'))
            ->schema([
                EstimateDebtUnemploymentForm::make(),
                EstimateDebtUnemploymentTable::make(),
            ])
            ->columns();
    }
}
