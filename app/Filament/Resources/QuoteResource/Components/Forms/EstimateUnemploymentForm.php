<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Models\QuoteFireConstructionType;
use App\Models\QuoteFireCreditType;
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

class EstimateUnemploymentForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required(fn ($get) => $get('life_insurance'))
                    ->maxDate(now())
                    ->live(debounce: 2000)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $set('age', Carbon::parse($state)->age);
                    }),

                Hidden::make('age'),

                DatePicker::make('co_debtor_birth_date')
                    ->label('Fecha de Nacimiento Codeudor (Si aplica)')
                    ->maxDate(now())
                    ->live(debounce: 2000)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $set('co_debtor_age', Carbon::parse($state)->age);
                    }),

                Hidden::make('co_debtor_age'),

                TextInput::make('deadline')
                    ->label('Plazo (meses)')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                Checkbox::make('guarantor')
                    ->label('Garante')
                    ->inline(false),

                Select::make('quote_fire_credit_type_id')
                    ->label('Tipo de crédito')
                    ->options(QuoteFireCreditType::pluck('name', 'id'))
                    ->required(),

                TextInput::make('appraisal_value')
                    ->label('Valor Tasación')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('financed_value')
                    ->label('Valor Financiado')
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
