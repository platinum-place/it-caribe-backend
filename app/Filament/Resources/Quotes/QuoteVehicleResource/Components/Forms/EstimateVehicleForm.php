<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Components\Forms;

use App\Models\Vehicles\VehicleMake;
use App\Models\Vehicles\VehicleModel;
use App\Models\Vehicles\VehicleUse;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class EstimateVehicleForm
{
    public static function make(): Grid
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
                        if (! $makeId) {
                            return [];
                        }

                        return VehicleModel::with('type')
                            ->where('vehicle_make_id', $makeId)
                            ->get()
                            ->mapWithKeys(function ($model) {
                                return [
                                    $model->id => $model->name.(
                                        $model->type ?
                                            ' ('.$model->type->name.')' :
                                            ''
                                    ),
                                ];
                            });
                    })
                    ->searchable()
                    ->required()
                    ->placeholder('Selecciona un modelo')
                    ->disabled(fn (Get $get) => ! $get('vehicle_make_id'))
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if (! $state) {
                            $set('vehicle_type_id', null);

                            return;
                        }

                        $set(
                            'vehicle_type_id',
                            VehicleModel::where('id', $state)
                                ->value('vehicle_type_id')
                        );
                    }),

                Hidden::make('vehicle_type_id'),

                TextInput::make('vehicle_year')
                    ->label('Año')
                    ->numeric()
                    ->required()
                    ->live()
                    ->minValue(1900)
                    ->maxValue(date('Y', strtotime('+1 year'))),

                TextInput::make('vehicle_amount')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required()
                    ->live()
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
                    ->live()
                    ->required(),

                Select::make('vehicle_use_id')
                    ->label('Uso')
                    ->options(VehicleUse::pluck('name', 'id'))
                    ->live()
                    ->required(),

                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'Nuevo' => '0 KM',
                        'Usado' => 'Usado',
                    ])
                    ->default('Nuevo')
                    ->live()
                    ->required(),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'Mensual' => 'Mensual',
                        'Anual' => 'Anual',
                    ])
                    ->default('Mensual')
                    ->live()
                    ->required(),

                Select::make('tipo_equipo')
                    ->label('Tipo de motor')
                    ->live()
                    ->options([
                        '4 cilindros' => '4 cilindros',
                        '6 cilindros' => '6 cilindros',
                    ]),
            ]);
    }
}
