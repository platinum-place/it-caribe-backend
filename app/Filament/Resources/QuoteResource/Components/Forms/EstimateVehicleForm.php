<?php

namespace App\Filament\Resources\QuoteResource\Components\Forms;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;

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
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if (! $state) {
                            $set('vehicle_type_id', null);

                            return;
                        }

                        $set('vehicle_type_id', VehicleModel::firstWhere('id', $state)->value('vehicle_type_id'));
                    }),

                Hidden::make('vehicle_type_id'),

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

                Checkbox::make('is_employee')
                    ->label('Empleado')
                    ->inline(false),

                Checkbox::make('leasing')
                    ->label('Responsabilidad Civil en Exceso')
                    ->inline(false),

                Radio::make('service_type')
                    ->label(__('Vehicle type'))
                    ->default('Clásico')
                    ->options([
                        'Clásico' => 'Clásico',
                        'Econo' => 'Japonés',
                        'Premier' => '0 KM',
                        'Híbrido' => 'Híbrido/Eléctrico',
                    ]),
            ]);
    }
}
