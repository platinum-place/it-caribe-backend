<?php

namespace App\Filament\Resources\QuoteFireResource\Components\Forms;

use App\Models\QuoteCreditType;
use App\Models\QuoteFireConstructionType;
use App\Models\QuoteFireRiskType;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class EstimateFireForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required(fn ($get) => $get('life_insurance'))
                    ->maxDate(now())
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $set('customer_age', Carbon::parse($state)->age);
                    }),

                Hidden::make('customer_age'),

                DatePicker::make('co_debtor_birth_date')
                    ->label('Fecha de Nacimiento Codeudor (Si aplica)')
                    ->maxDate(now())
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $set('co_debtor_age', Carbon::parse($state)->age);
                    }),

                Hidden::make('co_debtor_age'),

                TextInput::make('deadline')
                    ->label('Plazo')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                Checkbox::make('guarantor')
                    ->label('Garante')
                    ->inline(false),

                Select::make('quote_credit_type_id')
                    ->label('Tipo de crédito')
                    ->options(QuoteCreditType::pluck('name', 'id'))
                    ->required(),

                TextInput::make('property_value')
                    ->label('Valor de la Propiedad')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('loan_value')
                    ->label('Valor del Préstamo')
                    ->numeric()
                    ->required(fn ($get) => $get('life_insurance'))
                    ->prefix('$'),

                Select::make('quote_fire_risk_type_id')
                    ->label('Tipo de Riesgo')
                    ->required()
                    ->options(QuoteFireRiskType::pluck('name', 'id')),

                Select::make('quote_fire_construction_type_id')
                    ->label('Tipo de Construcción')
                    ->required()
                    ->options(QuoteFireConstructionType::pluck('name', 'id')),

                Checkbox::make('life_insurance')
                    ->label('Incluir plan Vida')
                    ->inline(false)
                    ->live()
                    ->default(true),

                TextInput::make('property_address')
                    ->translateLabel()
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
