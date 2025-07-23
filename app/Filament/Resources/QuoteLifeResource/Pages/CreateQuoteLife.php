<?php

namespace App\Filament\Resources\QuoteLifeResource\Pages;

use App\Enums\QuoteLineStatus;
use App\Enums\QuoteStatus;
use App\Enums\QuoteType;
use App\Filament\Resources\QuoteLifeResource;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\QuoteLife;
use App\Models\QuoteLifeLine;
use App\Models\QuoteLine;
use App\Services\Api\Zoho\ZohoCRMService;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateQuoteLife extends CreateRecord
{
    protected static string $resource = QuoteLifeResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    QuoteLifeResource\Components\Wizard\EstimateWizardStep::make(),
                    QuoteLifeResource\Components\Wizard\DebtorWizardStep::make(),
                    QuoteLifeResource\Components\Wizard\CoDebtorWizardStep::make()
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
            'Plan' => 'Vida/Consumo',
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
                'quote_type_id' => QuoteType::LIFE->value,
                'quote_status_id' => QuoteStatus::PENDING->value,
                'start_date' => now(),
                'id_crm' => $id,
                'end_date' => now()->addDays(30),
                'customer_id' => $customer->id,
                'user_id' => auth()->id(),
            ]);
            $quoteLife = QuoteLife::create([
                'quote_id' => $quote->id,
                'co_debtor_id' => ! empty($data['co_debtor_first_name']) ? $coDebtor?->id : null,
                'quote_credit_type_id' => $data['quote_credit_type_id'],
                'deadline' => $data['deadline'],
                'guarantor' => $data['guarantor'],
                'insured_amount' => $data['insured_amount'],
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
                $quoteLifeLine = QuoteLifeLine::create([
                    'quote_life_id' => $quoteLife->id,
                    'quote_line_id' => $quoteLine->id,
                    'debtor_amount' => $estimate['debtor_amount'],
                    'co_debtor_amount' => $estimate['co_debtor_amount'],
                    'debtor_rate' => $estimate['debtor_rate'],
                    'co_debtor_rate' => $estimate['co_debtor_rate'],
                ]);
            }

            return $quoteLife;
        });
    }
}
