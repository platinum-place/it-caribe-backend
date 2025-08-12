<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource\Pages;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Presentation\Filament\Forms\Components\Wizards\CreateDebtorWizardStep;
use Modules\Quote\Submodules\Vehicle\Domain\Contracts\EstimateVehicleQuoteInterface;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleActivity;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleColor;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleLoanType;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUse;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUtility;

class CreateQuoteVehicle extends CreateRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make(__('Estimate'))
                        ->schema([
                            Select::make('quote_vehicle.vehicle_make_id')
                                ->label('Marca')
                                ->options(VehicleMake::pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->placeholder('Selecciona una Marca'),

                            Select::make('quote_vehicle.vehicle_model_id')
                                ->label('Modelo')
                                ->options(function (Get $get) {
                                    $makeId = $get('quote_vehicle.vehicle_make_id');
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
                                ->disabled(fn (Get $get) => ! $get('quote_vehicle.vehicle_make_id'))
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                    if (! $state) {
                                        $set('quote_vehicle.vehicle_type_id', null);

                                        return;
                                    }

                                    $set('quote_vehicle.vehicle_type_id', VehicleModel::firstWhere('id', $state)->value('vehicle_type_id'));
                                }),

                            Hidden::make('quote_vehicle.vehicle_type_id'),

                            Select::make('quote_vehicle.vehicle_utility_id')
                                ->label(__('Vehicle type'))
                                ->options(VehicleUtility::pluck('name', 'id'))
                                ->searchable()
                                ->required(),

                            TextInput::make('quote_vehicle.vehicle_year')
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

                            \Filament\Forms\Components\Actions::make([
                                Action::make('generateEstimate')
                                    ->translateLabel()
                                    ->action(function (Set $set, Get $get) {
                                        $estimates = app(EstimateVehicleQuoteInterface::class)->handle(
                                            $get('quote_vehicle.vehicle_amount'),
                                            $get('quote_vehicle.vehicle_make_id'),
                                            $get('quote_vehicle.vehicle_model_id'),
                                            $get('quote_vehicle.vehicle_year'),
                                            $get('quote_vehicle.vehicle_type_id'),
                                            $get('quote_vehicle.vehicle_utility_id'),
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
                                ->hidden(fn (Get $get) => $get('estimates') === null)
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
                        ])
                        ->columns(),

                    Wizard\Step::make(__('Vehicle'))
                        ->schema([
                            TextInput::make('quote_vehicle.chassis')
                                ->label('Chasis')
                                ->required(),

                            TextInput::make('quote_vehicle.license_plate')
                                ->label('Placa'),

                            Select::make('quote_vehicle.vehicle_colors')
                                ->label('Color')
                                ->options(VehicleColor::pluck('name', 'id'))
                                ->multiple(),

                            Select::make('quote_vehicle.vehicle_activity_id')
                                ->label('Actividad del Vehículo')
                                ->options(VehicleActivity::pluck('name', 'id')),

                            Select::make('quote_vehicle.vehicle_use_id')
                                ->label('Uso')
                                ->options(VehicleUse::pluck('name', 'id'))
                                ->required(),

                            Select::make('quote_vehicle.vehicle_loan_type_id')
                                ->label('Tipo de préstamo')
                                ->required()
                                ->options(VehicleLoanType::pluck('name', 'id')),

                            TextInput::make('quote_vehicle.loan_amount')
                                ->label('Valor del Préstamo')
                                ->numeric()
                                ->required()
                                ->prefix('$'),
                        ])
                        ->columns(),

                    Wizard\Step::make(__('Others'))
                        ->schema([
                            DatePicker::make('quote.start_date')
                                ->translateLabel()
                                ->required()
                                ->default(now()),

                            DatePicker::make('quote.end_date')
                                ->translateLabel()
                                ->minDate(now())
//                    ->maxDate(now()->addDays(30))
//                    ->default(now()->addDays(30))
                                ->required(),
                        ])
                        ->columns(),

                    CreateDebtorWizardStep::make(),
                ])
                    ->columnSpanFull(),
            ]);
    }

    /**
     * @throws \Throwable
     */
    protected function handleRecordCreation(array $data): Model
    {
        return \DB::transaction(static function () use ($data) {
            dd($data);
        });
    }
}
