<?php

namespace App\Filament\Resources\QuoteVehicleResource\Components\Forms;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleUse;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;

class EstimateVehicleForm
{
    public static function make()
    {
        return Grid::make()
            ->schema([
                Select::make('vehicle_make_id')
                    ->label('Marca')
                    ->options(VehicleMake::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->placeholder('Selecciona una Marca'),

                Select::make('vehicle_model_id')
                    ->label('Modelo')
                    ->options(function (Get $get) {
                        $makeId = $get('vehicle_make_id');
                        if (!$makeId) {
                            return [];
                        }

                        return VehicleModel::with('type')
                            ->where('vehicle_make_id', $makeId)
                            ->get()
                            ->mapWithKeys(function ($model) {
                                $label = $model->name . ($model->type ? ' (' . $model->type->name . ')' : '');

                                return [$model->id => $label];
                            });
                    })
                    ->searchable()
                    ->required()
                    ->placeholder('Selecciona un modelo')
                    ->disabled(fn(Get $get) => !$get('vehicle_make_id')),

                TextInput::make('year')
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
                    ])
            ]);
    }
}
