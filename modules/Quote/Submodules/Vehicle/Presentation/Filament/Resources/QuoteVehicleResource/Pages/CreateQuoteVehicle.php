<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource\Pages;

use App\Services\EstimateQuoteVehicleService;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Presentation\Filament\Forms\Components\Wizards\CreateDebtorWizardStep;
use Modules\Quote\Submodules\Vehicle\Domain\Contracts\EstimateVehicleQuoteInterface;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\Wizard;
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
                                        ->where('make_id', $makeId)
                                        ->get()
                                        ->mapWithKeys(function ($model) {
                                            return [
                                                $model->id => $model->name . (
                                                    $model->type ?
                                                        ' (' . $model->type->name . ')' :
                                                        ''
                                                    ),
                                            ];
                                        });
                                })
                                ->searchable()
                                ->required()
                                ->placeholder('Selecciona un modelo')
                                ->disabled(fn(Get $get) => !$get('vehicle_make_id'))
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                    if (!$state) {
                                        $set('vehicle_type_id', null);

                                        return;
                                    }

                                    $set('vehicle_type_id', VehicleModel::firstWhere('id', $state)->value('type_id'));
                                }),

                            Hidden::make('vehicle_type_id'),

                            Select::make('vehicle_utility_id')
                                ->label(__('Vehicle type'))
                                ->options(VehicleUtility::pluck('name', 'id'))
                                ->searchable()
                                ->required(),

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

                            \Filament\Forms\Components\Actions::make([
                                Action::make('generateEstimate')
                                    ->translateLabel()
                                    ->action(function (Set $set, Get $get) {
                                        $estimates = app(EstimateVehicleQuoteInterface::class)->handle(
                                            $get('vehicle_amount'),
                                            $get('vehicle_make_id'),
                                            $get('vehicle_model_id'),
                                            $get('vehicle_year'),
                                            $get('vehicle_type_id'),
                                            $get('vehicle_utility_id'),
                                            $get('is_employee'),
                                            $get('leasing'),
                                        );

                                        $set('estimates_table', $estimates);
                                        $set('estimates', $estimates);
                                    })
                                    ->color('primary')
                                    ->icon('heroicon-o-calculator'),
                            ])
                                ->columnSpanFull(),

                            Hidden::make('estimates'),

                            Repeater::make('estimates_table')
                                ->hiddenLabel()
                                ->hidden(fn(Get $get) => $get('estimates') === null)
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
                        ->columns(),

                    CreateDebtorWizardStep::make(),
                ])
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRecordCreation(array $data): Model
    {
        return \DB::transaction(static function () use ($data) {

        });
    }
}
