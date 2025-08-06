<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Models\QuoteFireConstructionType;
use App\Models\QuoteFireCreditType;
use App\Models\QuoteFireRiskType;
use App\Models\QuoteUnemploymentDebtorType;
use App\Models\QuoteUnemploymentUseType;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class EstimateDebtUnemploymentForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                TextInput::make('insured_amount')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('deadline')
                    ->label('Plazo (meses)')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required()
                    ->maxDate(now()),

                TextInput::make('loan_installment')
                    ->label('Cuota préstamo')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                Select::make('quote_unemployment_use_type_id')
                    ->label('Tipo de empleado')
                    ->required()
                    ->options(QuoteUnemploymentUseType::pluck('name', 'id')),
            ]);
    }
}
