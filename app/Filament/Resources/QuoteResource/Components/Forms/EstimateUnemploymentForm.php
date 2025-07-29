<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use App\Models\QuoteFireConstructionType;
use App\Models\QuoteFireCreditType;
use App\Models\QuoteFireRiskType;
use App\Models\QuoteUnemploymentType;
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

class EstimateUnemploymentForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
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

                Select::make('quote_unemployment_type_id')
                    ->label('Modalidad pago prima')
                    ->required()
                    ->options(QuoteUnemploymentType::pluck('name', 'id')),

                Select::make('quote_unemployment_use_type_id')
                    ->label('Tipo de empleado')
                    ->required()
                    ->options(QuoteUnemploymentUseType::pluck('name', 'id')),
            ]);
    }
}
