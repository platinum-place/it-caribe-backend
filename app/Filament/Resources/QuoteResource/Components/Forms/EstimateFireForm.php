<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Models\QuoteFireConstructionType;
use App\Models\QuoteFireCreditType;
use App\Models\QuoteFireRiskType;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
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
                Fieldset::make(__('Quote life'))
                    ->schema([
                        DatePicker::make('birth_date')
                            ->label('Fecha de Nacimiento Deudor')
                            ->required(fn ($get) => $get('life_insurance'))
                            ->maxDate(now()),
                        DatePicker::make('co_debtor_birth_date')
                            ->label('Fecha de Nacimiento Codeudor (Si aplica)')
                            ->maxDate(now()),
                        TextInput::make('deadline')
                            ->label('Plazo (meses)')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        TextInput::make('financed_value')
                            ->label('Valor Financiado')
                            ->numeric()
                            ->required(fn ($get) => $get('life_insurance'))
                            ->prefix('$'),
                    ]),

                Fieldset::make(__('Quote fire'))
                    ->schema([
                        TextInput::make('appraisal_value')
                            ->label('Valor Tasación')
                            ->numeric()
                            ->required()
                            ->prefix('$'),
                    ]),

                Checkbox::make('life_insurance')
                    ->label('Incluir plan Vida')
                    ->inline(false)
                    ->live()
                    ->default(true),
            ]);
    }
}
