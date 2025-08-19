<?php

namespace App\Filament\Resources\QuoteResource\Components\Wizards;

use App\Models\Vehicle\VehicleActivity;
use App\Models\Vehicle\VehicleColor;
use App\Models\Vehicle\VehicleLoanType;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleUse;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Get;
use Filament\Forms\Set;

class Vehicle2WizardStep
{
    public static function make(): Wizard\Step
    {
        return Wizard\Step::make(__('Vehicle'))
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

                TextInput::make('chassis')
                    ->label('Chasis')
                    ->required(),

                TextInput::make('license_plate')
                    ->label('Placa'),

                Select::make('vehicle_colors')
                    ->label('Color')
                    ->options(VehicleColor::pluck('name', 'id'))
                    ->multiple(),

                Select::make('vehicle_activity_id')
                    ->label('Actividad del Vehículo')
                    ->options(VehicleActivity::pluck('name', 'id')),

                Select::make('vehicle_use_id')
                    ->label('Uso')
                    ->options(VehicleUse::pluck('name', 'id'))
                    ->required(),

                Select::make('vehicle_loan_type_id')
                    ->label('Tipo de préstamo')
                    ->required()
                    ->options(VehicleLoanType::pluck('name', 'id')),

                DatePicker::make('start_date')
                    ->translateLabel()
                    ->required()
                    ->default(now()),

                DatePicker::make('end_date')
                    ->translateLabel()
                    ->minDate(now())
//                    ->maxDate(now()->addDays(30))
//                    ->default(now()->addDays(30))
                    ->required(),

                TextInput::make('loan_amount')
                    ->label('Valor del Préstamo')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
            ])
            ->columns();
    }
}
