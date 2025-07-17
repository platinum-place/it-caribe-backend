<?php

namespace App\Filament\Resources\Components\Forms\Vehicles;

use App\Models\Vehicles\VehicleMake;
use App\Models\Vehicles\VehicleModel;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;

class MakeAndModelForm
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
            ]);
    }
}
