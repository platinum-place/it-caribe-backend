<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Models\folder\QuoteLifeCreditType;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;

class LifeWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Others'))
            ->schema([
                Checkbox::make('guarantor')
                    ->label('Garante')
                    ->inline(false),
                Select::make('quote_life_credit_type_id')
                    ->label('Tipo de crédito')
                    ->options(QuoteLifeCreditType::pluck('name', 'id'))
                    ->required(),
            ])
            ->columns();
    }
}
