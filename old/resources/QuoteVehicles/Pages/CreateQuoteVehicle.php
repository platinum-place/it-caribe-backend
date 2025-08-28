<?php

namespace old\Resources\QuoteVehicles\Pages;

use app\Enums\Quote\QuoteLineStatusEnum;
use app\Enums\Quote\QuoteStatusEnum;
use app\Enums\Quote\QuoteTypeEnum;
use App\Models\CRM\Lead;
use App\Models\Quote\Quote;
use App\Models\Quote\QuoteLine;
use App\Models\Quote\Vehicle\QuoteVehicle;
use App\Models\Quote\Vehicle\QuoteVehicleLine;
use App\Models\Vehicle\Vehicle;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use old\Resources\QuoteVehicles\QuoteVehicleResource;

class CreateQuoteVehicle extends CreateRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = auth()->user();

        $lead = Lead::create($data['lead']);

        $vehicle = Vehicle::create($data['vehicle']);

        $vehicle->vehicleColors()->attach($data['vehicle']['vehicle_colors']);

        $quote = Quote::create([
            'quote_status_id' => QuoteStatusEnum::PENDING->value,
            'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
            'lead_id' => $lead->id,
            'start_date' => $data['quote']['start_date'],
            'end_date' => $data['quote']['end_date'],
            'created_by' => $user->id,
        ]);

        $data['quote_vehicle']['quote_id'] = $quote->id;
        $data['quote_vehicle']['vehicle_id'] = $vehicle->id;

        $quoteVehicle = QuoteVehicle::create($data['quote_vehicle']);

        foreach ($data['lines'] as $line) {
            $quoteLine = QuoteLine::create([
                'name' => $line['vendor_name'],
                'description' => $line['description'],
                'quote_id' => $quote->id,
                'unit_price' => $line['unit_price'],
                'quantity' => $line['quantity'],
                'subtotal' => $line['subtotal'],
                'tax_rate' => $line['tax_rate'],
                'tax_amount' => $line['tax_amount'],
                'total' => $line['total'],
                'amount_taxed' => $line['amount_taxed'],
                'quote_line_status_id' => QuoteLineStatusEnum::NOT_ACCEPTED->value,
                'created_by' => 1,
            ]);

            $quoteVehicleLine = QuoteVehicleLine::create([
                'quote_vehicle_id' => $quoteVehicle->id,
                'quote_line_id' => $quoteLine->id,
                'life_amount' => $line['life_amount'],
                'vehicle_rate' => $line['vehicle_rate'],
                'total_monthly' => $line['total_monthly'],
                'latest_expenses' => $line['latest_expenses'],
                'markup' => $line['markup'],
                'amount_without_life_amount' => $line['amount_without_life_amount'],
                'created_by' => 1,
            ]);
        }

        return $quoteVehicle;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
