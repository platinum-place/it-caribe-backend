<?php

namespace App\Filament\Resources\QuoteFireResource\Pages;

use App\Enums\QuoteLineStatus;
use App\Enums\QuoteStatus;
use App\Enums\QuoteType;
use App\Filament\Resources\QuoteFireResource;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\QuoteFire;
use App\Models\QuoteFireLine;
use App\Models\QuoteLine;
use App\Services\Api\Zoho\ZohoCRMService;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateQuoteFire extends CreateRecord
{
    protected static string $resource = QuoteFireResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    QuoteFireResource\Components\Wizard\EstimateWizardStep::make(),
                    QuoteFireResource\Components\Wizard\DebtorWizardStep::make(),
                    QuoteFireResource\Components\Wizard\CoDebtorWizardStep::make()
                        ->hidden(fn ($get) => ! $get('co_debtor_birth_date')),
                ])
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $dataCRM = [
            'Subject' => $data['first_name'].' '.$data['last_name'],
            'Valid_Till' => date('Y-m-d', strtotime('+30 days')),
            'Vigencia_desde' => date('Y-m-d'),
            'Account_Name' => 3222373000092390001,
            'Contact_Name' => 3222373000203318001,
            'Quote_Stage' => 'Cotizando',
            'Plan' => 'Vida',
        ];

        foreach ($data['estimates'] as $estimate) {
            $dataCRM['Quoted_Items'][] = [
                'Quantity' => 1,
                'Product_Name' => $estimate['id_crm'],
                'Total' => round($estimate['total'], 2),
                'Net_Total' => round($estimate['total'], 2),
                'List_Price' => round($estimate['total'], 2),
            ];
        }

        $responseCRM = app(ZohoCRMService::class)->insertRecords('Quotes', $dataCRM);
        $id = $responseCRM['data'][0]['details']['id'];

        return DB::transaction(function () use ($id, $data) {
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
                'age' => $data['customer_age'] ?? null,
            ]);
            if (! empty($data['co_debtor_first_name'])) {
                $coDebtor = Customer::create([
                    'first_name' => $data['co_debtor_first_name'],
                    'last_name' => $data['co_debtor_last_name'],
                    'identity_number' => $data['co_debtor_identity_number'],
                    'birth_date' => $data['co_debtor_birth_date'] ?? null,
                    'home_phone' => $data['co_debtor_home_phone'] ?? null,
                    'mobile_phone' => $data['co_debtor_mobile_phone'] ?? null,
                    'work_phone' => $data['co_debtor_work_phone'] ?? null,
                    'email' => $data['co_debtor_email'] ?? null,
                    'address' => $data['co_debtor_address'] ?? null,
                ]);
            }
            $quote = Quote::create([
                'quote_type_id' => QuoteType::FIRE->value,
                'quote_status_id' => QuoteStatus::PENDING->value,
                'start_date' => now(),
                'id_crm' => $id,
                'end_date' => now()->addDays(30),
                'customer_id' => $customer->id,
                'user_id' => auth()->id(),
            ]);
            $quoteFire = QuoteFire::create([
                'quote_id' => $quote->id,
                'co_debtor_id' => ! empty($data['co_debtor_first_name']) ? $coDebtor?->id : null,
                'quote_credit_type_id' => $data['quote_credit_type_id'],
                'deadline' => $data['deadline'],
                'guarantor' => $data['guarantor'],
                'quote_fire_risk_type_id' => $data['quote_fire_risk_type_id'],
                'quote_fire_construction_type_id' => $data['quote_fire_construction_type_id'],
                'property_value' => $data['property_value'],
                'loan_value' => $data['loan_value'],
                'property_address' => $data['property_address'],
            ]);

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

            return $quoteFire;
        });
    }
}
