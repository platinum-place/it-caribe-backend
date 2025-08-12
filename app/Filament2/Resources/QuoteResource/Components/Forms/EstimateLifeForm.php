<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

class EstimateLifeForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required()
                    ->maxDate(now()),

                DatePicker::make('co_debtor_birth_date')
                    ->label('Fecha de Nacimiento Codeudor (Si aplica)')
                    ->maxDate(now()),

                TextInput::make('deadline')
                    ->label('Plazo (meses)')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                TextInput::make('insured_amount')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
            ]);
    }
}
