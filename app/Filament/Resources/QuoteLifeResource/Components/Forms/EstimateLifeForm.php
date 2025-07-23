<?php

namespace App\Filament\Resources\QuoteLifeResource\Components\Forms;

use App\Models\QuoteCreditType;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class EstimateLifeForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                DatePicker::make('birth_date')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required()
                    ->maxDate(now())
                    ->live(debounce: 500)
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
                    ->label('Plazo en meses')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                TextInput::make('insured_amount')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                Checkbox::make('guarantor')
                    ->label('Garante')
                    ->inline(false),

                Select::make('quote_credit_type_id')
                    ->label('Tipo de crédito')
                    ->options(QuoteCreditType::pluck('name', 'id'))
                    ->required(),
            ]);
    }
}
