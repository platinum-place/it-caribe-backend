<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Enums\QuoteLineStatus;
use App\Enums\QuoteStatus;
use App\Enums\QuoteType;
use App\Filament\Resources\QuoteResource;
use App\Models\Debtor;
use App\Models\Quote;
use App\Models\QuoteDebtUnemployment;
use App\Models\QuoteDebtUnemploymentLine;
use App\Models\QuoteFire;
use App\Models\QuoteFireLine;
use App\Models\QuoteLife;
use App\Models\QuoteLifeLine;
use App\Models\QuoteLine;
use App\Models\QuoteUnemployment;
use App\Models\QuoteUnemploymentLine;
use App\Models\QuoteVehicle;
use App\Models\QuoteVehicleLine;
use App\Models\Vehicle;
use Carbon\Carbon;
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
                    QuoteResource\Components\Wizards\VehicleWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::VEHICLE->value),

                    QuoteResource\Components\Wizards\EstimateLifeWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::LIFE->value),
                    QuoteResource\Components\Wizards\LifeWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::LIFE->value),

                    QuoteResource\Components\Wizards\EstimateFireWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::FIRE->value),
                    QuoteResource\Components\Wizards\FireWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::FIRE->value),

                    QuoteResource\Components\Wizards\EstimateUnemploymentWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == QuoteType::UNEMPLOYMENT->value),

                    QuoteResource\Components\Wizards\EstimateDebtUnemploymentWizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == 6),

                    QuoteResource\Components\Wizards\DebtorWizardStep::make(),
                    QuoteResource\Components\Wizards\CoDebtorWizardStep::make()
                        ->hidden(fn($get) => !$get('co_debtor_birth_date')),

                    QuoteResource\Components\Wizards\Vehicle2WizardStep::make()
                        ->visible(fn($get): bool => $get('quote_type_id') == 6),
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
            $debtor = Debtor::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'identity_number' => $data['identity_number'],
                'birth_date' => $data['birth_date'] ?? null,
                'home_phone' => $data['home_phone'] ?? null,
                'mobile_phone' => $data['mobile_phone'] ?? null,
                'work_phone' => $data['work_phone'] ?? null,
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,
                'age' => Carbon::parse($data['birth_date'])->age,
            ]);
            if (!empty($data['co_debtor_first_name'])) {
                $coDebtor = Debtor::create([
                    'first_name' => $data['co_debtor_first_name'],
                    'last_name' => $data['co_debtor_last_name'],
                    'identity_number' => $data['co_debtor_identity_number'],
                    'birth_date' => $data['co_debtor_birth_date'] ?? null,
                    'home_phone' => $data['co_debtor_home_phone'] ?? null,
                    'mobile_phone' => $data['co_debtor_mobile_phone'] ?? null,
                    'work_phone' => $data['co_debtor_work_phone'] ?? null,
                    'email' => $data['co_debtor_email'] ?? null,
                    'address' => $data['co_debtor_address'] ?? null,
                    'age' => Carbon::parse($data['co_debtor_birth_date'])->age,
                ]);
            }
            $quote = Quote::create([
                'quote_type_id' => $data['quote_type_id'],
                'quote_status_id' => QuoteStatus::PENDING->value,
                'start_date' => $data['start_date'] ?? now(),
                'end_date' => $data['end_date'] ?? now()->addDays(30),
                'debtor_id' => $debtor->id,
                'user_id' => auth()->id(),
            ]);
            if ($data['quote_type_id'] == 6) {
                $vehicle = Vehicle::create([
                    'vehicle_year' => $data['vehicle_year'],
                    'chassis' => $data['chassis'],
                    'license_plate' => $data['license_plate'],
                    'vehicle_make_id' => $data['vehicle_make_id'],
                    'vehicle_model_id' => $data['vehicle_model_id'],
                    'vehicle_type_id' => $data['vehicle_type_id'],
                ]);
                $quoteDebtUnemployment = QuoteDebtUnemployment::create([
                    'quote_id' => $quote->id,
                    'vehicle_id' => $vehicle->id,
                    'vehicle_make_id' => $data['vehicle_make_id'],
                    'vehicle_year' => $data['vehicle_year'],
                    'vehicle_model_id' => $data['vehicle_model_id'],
                    'vehicle_type_id' => $data['vehicle_type_id'],
                    'vehicle_use_id' => $data['vehicle_use_id'],
                    'vehicle_activity_id' => $data['vehicle_activity_id'],
                    'vehicle_amount' => $data['vehicle_amount'],
                    'vehicle_loan_type_id' => $data['vehicle_loan_type_id'],
                    'loan_amount' => $data['loan_amount'],
                    'insured_amount' => $data['insured_amount'],
                    'quote_unemployment_use_type_id' => $data['quote_unemployment_use_type_id'],
                ]);
            }
            if ($data['quote_type_id'] == QuoteType::VEHICLE->value) {
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
                    'vehicle_loan_type_id' => $data['vehicle_loan_type_id'],
                    'is_employee' => $data['is_employee'],
                    'leasing' => $data['leasing'],
                    'loan_amount' => $data['loan_amount'],
                ]);
                $vehicle->colors()->attach($data['vehicle_colors']);
                $quoteVehicle->vehicleColors()->attach($data['vehicle_colors']);
            }
            if ($data['quote_type_id'] == QuoteType::LIFE->value) {
                $quoteLife = QuoteLife::create([
                    'quote_id' => $quote->id,
                    'co_debtor_id' => !empty($data['co_debtor_first_name']) ? $coDebtor?->id : null,
                    'quote_life_credit_type_id' => $data['quote_life_credit_type_id'],
                    'deadline' => $data['deadline'],
                    'guarantor' => $data['guarantor'],
                    'insured_amount' => $data['insured_amount'],
                ]);
            }
            if ($data['quote_type_id'] == QuoteType::FIRE->value) {
                $quoteFire = QuoteFire::create([
                    'quote_id' => $quote->id,
                    'co_debtor_id' => !empty($data['co_debtor_first_name']) ? $coDebtor?->id : null,
                    'quote_fire_credit_type_id' => $data['quote_fire_credit_type_id'],
                    'deadline' => $data['deadline'] / 12,
                    'guarantor' => $data['guarantor'],
                    'quote_fire_risk_type_id' => $data['quote_fire_risk_type_id'],
                    'quote_fire_construction_type_id' => $data['quote_fire_construction_type_id'],
                    'appraisal_value' => $data['appraisal_value'],
                    'financed_value' => $data['financed_value'],
                    'property_address' => $data['property_address'],
                ]);
            }
            if ($data['quote_type_id'] == QuoteType::UNEMPLOYMENT->value) {
                $quoteUnemployment = QuoteUnemployment::create([
                    'quote_id' => $quote->id,
                    'quote_unemployment_debtor_type_id' => $data['quote_unemployment_debtor_type_id'],
                    'quote_unemployment_use_type_id' => $data['quote_unemployment_use_type_id'],
                    'deadline' => $data['deadline'],
                    'loan_installment' => $data['loan_installment'],
                ]);
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
                if ($data['quote_type_id'] == 6) {
                    $quoteDebtUnemploymentLine = QuoteDebtUnemploymentLine::create([
                        'quote_debt_unemployment_id' => $quoteDebtUnemployment->id,
                        'quote_line_id' => $quoteLine->id,
                        'rate' => $estimate['rate'],
                        'rate2' => $estimate['rate2'],
                        'total2' => $estimate['total2'],
                        'total1' => $estimate['total1'],
                    ]);
                }
                if ($data['quote_type_id'] == QuoteType::VEHICLE->value) {
                    $quoteVehicleLine = QuoteVehicleLine::create([
                        'quote_vehicle_id' => $quoteVehicle->id,
                        'quote_line_id' => $quoteLine->id,
                        'life_amount' => $estimate['life_amount'],
                    ]);
                }
                if ($data['quote_type_id'] == QuoteType::LIFE->value) {
                    $quoteLifeLine = QuoteLifeLine::create([
                        'quote_life_id' => $quoteLife->id,
                        'quote_line_id' => $quoteLine->id,
                        'debtor_amount' => $estimate['debtor_amount'],
                        'co_debtor_amount' => $estimate['co_debtor_amount'],
                        'debtor_rate' => $estimate['debtor_rate'],
                        'co_debtor_rate' => $estimate['co_debtor_rate'],
                    ]);
                }
                if ($data['quote_type_id'] == QuoteType::FIRE->value) {
                    $quoteFireLine = QuoteFireLine::create([
                        'quote_fire_id' => $quoteFire->id,
                        'quote_line_id' => $quoteLine->id,
                        'debtor_amount' => $estimate['debtor_amount'],
                        'co_debtor_amount' => $estimate['co_debtor_amount'],
                        'debtor_rate' => $estimate['debtor_rate'],
                        'co_debtor_rate' => $estimate['co_debtor_rate'],
                        'fire_rate' => $estimate['fire_rate'],
                        'fire_amount' => $estimate['fire_amount'],
                        'life_amount' => $estimate['life_amount'],
                    ]);
                }
                if ($data['quote_type_id'] == QuoteType::UNEMPLOYMENT->value) {
                    $quoteUnemploymentLine = QuoteUnemploymentLine::create([
                        'quote_unemployment_id' => $quoteUnemployment->id,
                        'quote_line_id' => $quoteLine->id,
                        'rate' => $estimate['rate'],
                    ]);
                }
            }

            return $quote;
        });
    }
}
