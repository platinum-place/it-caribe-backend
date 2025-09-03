<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\Pages;

use App\Filament\Branch\Resources\QuoteVehicles\QuoteVehicleResource;
use App\Filament\Forms\Components\Wizards\CreateLeadWizardStep;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Model;
use Modules\Application\Insurances\Core\UseCases\EstimateVehicleUseCase;
use Modules\Domain\Quotations\Core\Enums\QuoteLineStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteStatusEnum;
use Modules\Domain\Quotations\Core\Enums\QuoteTypeEnum;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\Vehicle;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleActivity;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleColor;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleLoanType;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleMake;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleModel;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleUse;
use Modules\Infrastructure\Catalogs\Vehicles\Persistence\Models\VehicleUtility;
use Modules\Infrastructure\CRM\Persistence\Models\Lead;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\Quote;
use Modules\Infrastructure\Quotations\Core\Persistence\Models\QuoteLine;
use Modules\Infrastructure\Quotations\Products\Vehicle\Persistence\Models\QuoteVehicle;
use Modules\Infrastructure\Quotations\Products\Vehicle\Persistence\Models\QuoteVehicleLine;

class CreateQuoteVehicle extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = QuoteVehicleResource::class;

    protected function getSteps(): array
    {
        return [
            CreateLeadWizardStep::make(),

            Step::make('Vehículo')
                ->schema([
                    Select::make('vehicle.vehicle_make_id')
                        ->label('Marca')
                        ->searchable()
                        ->options(VehicleMake::pluck('name', 'id'))
                        ->live()
                        ->required(),

                    Select::make('vehicle.vehicle_model_id')
                        ->label('Modelo')
                        ->searchable()
                        ->options(fn (Get $get) => VehicleModel::where('vehicle_make_id', $get('vehicle.vehicle_make_id'))->pluck('name', 'id'))
                        ->live()
                        ->required(),

                    Select::make('vehicle.vehicle_utility_id')
                        ->label('Tipo de vehículo ')
                        ->options(VehicleUtility::pluck('name', 'id'))
                        ->required(),

                    TextInput::make('vehicle.chassis')
                        ->label('Chasis')
                        ->required(),

                    TextInput::make('vehicle.vehicle_year')
                        ->label('Año')
                        ->numeric()
                        ->required()
                        ->minValue(1900)
                        ->maxValue(date('Y', strtotime('+1 year'))),

                    TextInput::make('vehicle.vehicle_amount')
                        ->label('Suma asegurada')
                        ->numeric()
                        ->required()
                        ->prefix('$'),

                    Checkbox::make('vehicle.is_employee')
                        ->label('Empleado')
                        ->inline(false),

                    Checkbox::make('vehicle.leasing')
                        ->label('Responsabilidad civil en exceso')
                        ->inline(false),

                    TextInput::make('vehicle.license_plate')
                        ->label('Placa')
                        ->required(),

                    Select::make('vehicle.vehicle_colors')
                        ->label('Colores')
                        ->options(VehicleColor::pluck('name', 'id'))
                        ->multiple(),

                    Select::make('vehicle.vehicle_activity_id')
                        ->label('Actividad del vehículo')
                        ->options(VehicleActivity::pluck('name', 'id')),

                    Select::make('vehicle.vehicle_use_id')
                        ->label('Uso')
                        ->options(VehicleUse::pluck('name', 'id'))
                        ->required(),

                    Select::make('vehicle.vehicle_loan_type_id')
                        ->label('Tipo de préstamo')
                        ->live()
                        ->options(VehicleLoanType::pluck('name', 'id')),

                    TextInput::make('vehicle.vehicle_loan_amount')
                        ->label('Valor del préstamo')
                        ->numeric()
                        ->required(fn (Get $get) => $get('vehicle.vehicle_loan_type_id'))
                        ->prefix('$'),
                ])
                ->columns(),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $lead = Lead::create($data['lead']);

        $quote = Quote::create([
            'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
            'quote_status_id' => QuoteStatusEnum::PENDING->value,
            'lead_id' => $lead->id,
            'start_date' => now(),
        ]);

        $vehicle = Vehicle::create($data['vehicle']);

        $vehicle->vehicleColors()->sync($data['vehicle']['vehicle_colors']);

        $quoteVehicle = QuoteVehicle::create([
            'quote_id' => $quote->id,
            'vehicle_id' => $vehicle->id,
            'vehicle_amount' => $data['vehicle']['vehicle_amount'],
            'is_employee' => $data['vehicle']['is_employee'],
            'leasing' => $data['vehicle']['leasing'],
            'vehicle_loan_amount' => $data['vehicle']['vehicle_loan_amount'],
        ]);

        $lines = app(EstimateVehicleUseCase::class)->handle(
            $vehicle->vehicleMake->name,
            $vehicle->vehicleModel->name,
            $vehicle->vehicleType->name,
            $vehicle->vehicleUtility->name,
            $vehicle->vehicle_year,
            $quoteVehicle->vehicle_amount,
        );

        foreach ($lines as $line) {
            $quoteLine = QuoteLine::create([
                'name' => $line->vendorName,
                'description' => $line->idCrm,
                'quote_id' => $quote->id,
                'quantity' => 1,
                'total' => $line->total,
                'quote_line_status_id' => QuoteLineStatusEnum::NOT_ACCEPTED->value,
                'unit_price' => $line->amountTaxed,
                'amount_taxed' => $line->amountTaxed,
                'subtotal' => $line->total,
                'tax_rate' => $line->taxRate,
                'tax_amount' => $line->taxAmount,
            ]);
            $quoteVehicleLine = QuoteVehicleLine::create([
                'quote_vehicle_id' => $quoteVehicle->id,
                'quote_line_id' => $quoteLine->id,
                'total_monthly' => $line->totalMonthly,
                'amount_without_life_amount' => $line->amountWithoutLifeAmount,
                'life_amount' => $line->lifeAmount,
                'vehicle_rate' => $line->vehicleRate,
                'latest_expenses' => $line->latestExpenses,
                'markup' => $line->markup,
            ]);
        }

        return $quoteVehicle;
    }
}
