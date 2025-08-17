<?php

namespace App\Filament\Resources\QuoteVehicles\Schemas;

use App\Filament\Forms\Components\Wizards\CreateLeadWizardStep;
use App\Models\Vehicle\VehicleActivity;
use App\Models\Vehicle\VehicleColor;
use App\Models\Vehicle\VehicleLoanType;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleUse;
use App\Models\Vehicle\VehicleUtility;
use App\Services\Quote\Vehicle\EstimateQuoteVehicleService;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class QuoteVehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make(__('Estimate'))
                        ->schema([
                            Select::make('vehicle.vehicle_make_id')
                                ->label('Marca')
                                ->options(VehicleMake::pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->placeholder('Selecciona una Marca'),

                            Select::make('vehicle.vehicle_model_id')
                                ->label('Modelo')
                                ->options(function ($get) {
                                    $makeId = $get('vehicle.vehicle_make_id');
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
                                ->disabled(fn ($get) => ! $get('vehicle.vehicle_make_id'))
                                ->afterStateUpdated(function ($get, $set, $state) {
                                    if (! $state) {
                                        $set('vehicle.vehicle_type_id', null);

                                        return;
                                    }

                                    $set('vehicle.vehicle_type_id', VehicleModel::firstWhere('id', $state)->value('vehicle_type_id'));
                                }),

                            Hidden::make('vehicle.vehicle_type_id'),

                            Select::make('vehicle.vehicle_utility_id')
                                ->label(__('Vehicle type'))
                                ->options(VehicleUtility::pluck('name', 'id'))
                                ->required(),

                            TextInput::make('vehicle.vehicle_year')
                                ->label('Año')
                                ->numeric()
                                ->required()
                                ->minValue(1900)
                                ->maxValue(date('Y', strtotime('+1 year'))),

                            TextInput::make('quote_vehicle.vehicle_amount')
                                ->label('Suma Asegurada')
                                ->numeric()
                                ->required()
                                ->prefix('$'),

                            Checkbox::make('quote_vehicle.is_employee')
                                ->label('Empleado')
                                ->inline(false),

                            Checkbox::make('quote_vehicle.leasing')
                                ->label('Responsabilidad Civil en Exceso')
                                ->inline(false),

                            Actions::make([
                                Action::make('generateEstimate')
                                    ->translateLabel()
                                    ->action(function ($set, $get) {
                                        $estimates = app(EstimateQuoteVehicleService::class)->handle(
                                            $get('quote_vehicle.vehicle_amount'),
                                            $get('vehicle.vehicle_make_id'),
                                            $get('vehicle.vehicle_model_id'),
                                            $get('vehicle.vehicle_year'),
                                            $get('vehicle.vehicle_type_id'),
                                            $get('vehicle.vehicle_utility_id'),
                                            $get('quote_vehicle.is_employee'),
                                            $get('quote_vehicle.leasing'),
                                        );

                                        $set('estimates_table', $estimates);
                                        $set('lines', $estimates);
                                    })
                                    ->color('primary')
                                    ->icon('heroicon-o-calculator'),
                            ])
                                ->columnSpanFull(),

                            Hidden::make('lines'),

                            Repeater::make('estimates_table')
                                ->hiddenLabel()
                                ->hidden(fn ($get) => $get('lines') === null)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Aseguradora')
                                        ->disabled()
                                        ->dehydrated(false),

                                    TextInput::make('total_monthly')
                                        ->label('Total mensual')
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->prefix('RD$')
                                        ->mask(RawJs::make('$money($input)'))
                                        ->stripCharacters(',')
                                        ->numeric(),

                                    TextInput::make('error')
                                        ->label('Comentario')
                                        ->disabled()
                                        ->dehydrated(false),
                                ])
                                ->columns(3)
                                ->deletable(false)
                                ->reorderable(false)
                                ->addable(false)
                                ->columnSpanFull(),
                        ]),
                    Step::make(__('Others'))
                        ->schema([
                            DatePicker::make('quote.start_date')
                                ->translateLabel()
                                ->required(),

                            DatePicker::make('quote.end_date')
                                ->translateLabel()
                                ->required(),
                        ]),
                    Step::make(__('Vehicle'))
                        ->schema([
                            TextInput::make('vehicle.chassis')
                                ->label('Chasis')
                                ->required(),

                            TextInput::make('vehicle.license_plate')
                                ->required()
                                ->label('Placa'),

                            Select::make('vehicle.vehicle_colors')
                                ->label('Color')
                                ->options(VehicleColor::pluck('name', 'id'))
                                ->multiple(),

                            Select::make('vehicle.vehicle_activity_id')
                                ->label('Actividad del Vehículo')
                                ->options(VehicleActivity::pluck('name', 'id')),

                            Select::make('vehicle.vehicle_use_id')
                                ->label('Uso')
                                ->options(VehicleUse::pluck('name', 'id'))
                                ->required(),

                            Select::make('vehicle.vehicle_loan_type_id')
                                ->label('Tipo de préstamo')
                                ->required()
                                ->options(VehicleLoanType::pluck('name', 'id')),

                            TextInput::make('quote_vehicle.loan_amount')
                                ->label('Valor del Préstamo')
                                ->numeric()
                                ->required()
                                ->prefix('$'),
                        ]),

                    CreateLeadWizardStep::make(),
                ])
                    ->columnSpanFull()
                    ->columns(),
            ]);
    }
}
