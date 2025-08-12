<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Filament\Resources\QuoteResource\Components\Forms\EstimateFireForm;
use App\Filament\Resources\QuoteResource\Components\Forms\EstimateFireTable;
use Filament\Forms\Components\Wizard;

class EstimateFireWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Quote fire'))
            ->schema([
                EstimateFireForm::make(),
                EstimateFireTable::make(),
            ])
            ->columns();
    }
}
