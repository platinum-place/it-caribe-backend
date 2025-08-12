<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Filament\Resources\QuoteResource\Components\Forms\EstimateLifeForm;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateLifeTable;
use Filament\Forms\Components\Wizard;

class EstimateLifeWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Quote life'))
            ->schema([
                EstimateLifeForm::make(),
                EstimateLifeTable::make(),
            ])
            ->columns();
    }
}
