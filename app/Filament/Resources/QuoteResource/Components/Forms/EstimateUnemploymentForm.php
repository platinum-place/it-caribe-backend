<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Models\QuoteUnemploymentDebtorType;
use App\Models\QuoteUnemploymentUseType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class EstimateUnemploymentForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required()
                    ->maxDate(now()),

                TextInput::make('loan_installment')
                    ->label('Cuota préstamo')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('deadline')
                    ->label('Plazo (meses)')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                Select::make('quote_unemployment_debtor_type_id')
                    ->label('Modalidad pago prima')
                    ->required()
                    ->options(QuoteUnemploymentDebtorType::pluck('name', 'id')),

                Select::make('quote_unemployment_use_type_id')
                    ->label('Tipo de empleado')
                    ->required()
                    ->options(QuoteUnemploymentUseType::pluck('name', 'id')),
            ]);
    }
}
