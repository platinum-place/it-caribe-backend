<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Enums\QuoteLineStatus;
use App\Enums\QuoteStatus;
use App\Enums\QuoteType;
use App\Filament\Resources\QuoteResource;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\QuoteLine;
use App\Models\QuoteVehicle;
use App\Models\QuoteVehicleLine;
use App\Models\Vehicle;
use DB;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make(__('Estimate'))
                        ->schema([
                            Select::make('quote_type_id')
                                ->relationship(name: 'type', titleAttribute: 'name')
                                ->translateLabel()
                                ->live()
                                ->required(),
                        ]),
                    QuoteResource\Components\Wizards\EstimateVehicleWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::VEHICLE->value),
                    QuoteResource\Components\Wizards\CustomerWizardStep::make(),
                    QuoteResource\Components\Wizards\VehicleWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::VEHICLE->value),
                ])
                    ->columnSpanFull(),
            ]);
    }

    /**
     * @throws \Throwable
     */
    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(static function () use ($data) {
            $customer = Customer::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'identity_number' => $data['identity_number'],
                'birth_date' => $data['birth_date'] ?? null,
                'home_phone' => $data['home_phone'] ?? null,
                'mobile_phone' => $data['mobile_phone'] ?? null,
                'work_phone' => $data['work_phone'] ?? null,
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,
                'age' => $data['age'] ?? null,
            ]);
            $quote = Quote::create([
                'quote_type_id' => QuoteType::VEHICLE->value,
                'quote_status_id' => QuoteStatus::PENDING->value,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'customer_id' => $customer->id,
                'user_id' => auth()->id(),
            ]);
            if (isset($data['vehicle_year'])) {
                $vehicle = Vehicle::create([
                    'vehicle_year' => $data['vehicle_year'],
                    'chassis' => $data['chassis'],
                    'license_plate' => $data['license_plate'],
                    'vehicle_make_id' => $data['vehicle_make_id'],
                    'vehicle_model_id' => $data['vehicle_model_id'],
                    'vehicle_type_id' => $data['vehicle_type_id'],
                ]);
                $quoteVehicle = QuoteVehicle::create([
                    'quote_id' => $quote->id,
                    'vehicle_id' => $vehicle->id,
                    'vehicle_make_id' => $data['vehicle_make_id'],
                    'vehicle_year' => $data['vehicle_year'],
                    'vehicle_model_id' => $data['vehicle_model_id'],
                    'vehicle_type_id' => $data['vehicle_type_id'],
                    'vehicle_use_id' => $data['vehicle_use_id'],
                    'vehicle_activity_id' => $data['vehicle_activity_id'],
                    'vehicle_amount' => $data['vehicle_amount'],
                ]);
                $vehicle->colors()->attach($data['vehicle_colors']);
                $quoteVehicle->vehicleColors()->attach($data['vehicle_colors']);
            }

            foreach ($data['estimates'] as $estimate) {
                $quoteLine = QuoteLine::create([
                    'name' => $estimate['name'],
                    'unit_price' => $estimate['unit_price'],
                    'quantity' => $estimate['quantity'],
                    'subtotal' => $estimate['subtotal'],
                    'amount_taxed' => $estimate['amount_taxed'],
                    'tax_rate' => $estimate['tax_rate'],
                    'tax_amount' => $estimate['tax_amount'],
                    'total' => $estimate['total'],
                    'quote_id' => $quote->id,
                    'id_crm' => $estimate['id_crm'],
                    'quote_line_status_id' => QuoteLineStatus::NOT_ACCEPTED->value,
                ]);
                if (isset($data['vehicle_year'])) {
                    $quoteVehicleLine = QuoteVehicleLine::create([
                        'quote_vehicle_id' => $quoteVehicle->id,
                        'quote_line_id' => $quoteLine->id,
                        'life_amount' => $estimate['life_amount'],
                    ]);
                }
            }

            return $quote;
        });
    }
}
