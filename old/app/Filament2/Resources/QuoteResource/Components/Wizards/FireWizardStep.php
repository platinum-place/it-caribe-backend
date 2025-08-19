<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Models\folder\QuoteFireConstructionType;
use App\Models\folder\QuoteFireCreditType;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;

class FireWizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Others'))
            ->schema([
                Checkbox::make('guarantor')
                    ->label('Garante')
                    ->inline(false),
                Select::make('quote_fire_construction_type_id')
                    ->label('Tipo de Construcción')
                    ->required()
                    ->options(QuoteFireConstructionType::pluck('name', 'id')),
                Select::make('quote_fire_credit_type_id')
                    ->label('Tipo de crédito')
                    ->options(QuoteFireCreditType::pluck('name', 'id'))
                    ->required(),
                TextInput::make('property_address')
                    ->translateLabel()
                    ->columnSpanFull()
                    ->required(),
            ])
            ->columns();
    }
}
