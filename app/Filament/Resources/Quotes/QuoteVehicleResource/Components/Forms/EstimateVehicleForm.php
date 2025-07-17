<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Components\Forms;

use App\Filament\Resources\Components\Forms\Vehicles\MakeAndModelForm;
use App\Models\Vehicles\VehicleUse;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class EstimateVehicleForm
{
    public static function make(): Grid
    {
        return Grid::make()
            ->schema([
                MakeAndModelForm::make(),

                TextInput::make('vehicle_year')
                    ->label('Año')
                    ->numeric()
                    ->required()
                    ->minValue(1900)
                    ->maxValue(date('Y', strtotime('+1 year'))),

                TextInput::make('vehicle_amount')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                Select::make('plan')
                    ->label('Plan')
                    ->options([
                        'Full' => 'Full',
                        'Ley' => 'Ley',
                        'Econo' => 'Econo',
                        'Premier' => '0 KM',
                        'Eléctrico/Híbrido' => 'Eléctrico/Híbrido',
                        'Empleado' => 'Empleado',
                    ])
                    ->default('Mensual full')
                    ->required(),

                Select::make('vehicle_use_id')
                    ->label('Uso')
                    ->options(VehicleUse::pluck('name', 'id'))
                    ->required(),

                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'Nuevo' => '0 KM',
                        'Usado' => 'Usado',
                    ])
                    ->default('Nuevo')
                    ->required(),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'Mensual' => 'Mensual',
                        'Anual' => 'Anual',
                    ])
                    ->default('Mensual')
                    ->required(),

                Select::make('tipo_equipo')
                    ->label('Tipo de motor')
                    ->options([
                        '4 cilindros' => '4 cilindros',
                        '6 cilindros' => '6 cilindros',
                    ]),
            ]);
    }
}
