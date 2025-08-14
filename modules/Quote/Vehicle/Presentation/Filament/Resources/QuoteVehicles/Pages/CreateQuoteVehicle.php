<?php

namespace Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicles\Pages;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Enums\Quote\QuoteTypeEnum;
use App\Models\CRM\Debtor;
use App\Models\Quote\Quote;
use App\Models\Quote\QuoteLine;
use App\Models\Vehicle\Vehicle;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Quote\Vehicle\Infrastructure\Persistence\Models\QuoteVehicle;
use Modules\Quote\Vehicle\Infrastructure\Persistence\Models\QuoteVehicleLine;
use Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicles\QuoteVehicleResource;

class CreateQuoteVehicle extends CreateRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = auth()->user();
        $data['debtor']['created_by'] = $user->id;
        $data['vehicle']['created_by'] = $user->id;

        $debtor = Debtor::create($data['debtor']);
        $vehicle = Vehicle::create($data['vehicle']);

        $vehicle->vehicleColors()->attach($data['vehicle']['vehicle_colors']);
        //        $vehicle->vehicleRoutes()->attach($data['vehicle']['vehicle_colors']);
        //        $vehicle->vehicleAccessories()->attach($data['vehicle']['vehicle_colors']);

        $quote = Quote::create([
            'quote_status_id' => QuoteStatusEnum::PENDING->value,
            'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
            'debtor_id' => $debtor->id,
            'start_date' => $data['quote']['start_date'],
            'end_date' => $data['quote']['end_date'],
            'created_by' => $user->id,
        ]);

        $data['quote_vehicle']['created_by'] = $user->id;
        $data['quote_vehicle']['quote_id'] = $quote->id;
        $data['quote_vehicle']['vehicle_id'] = $vehicle->id;

        $quoteVehicle = QuoteVehicle::create($data['quote_vehicle']);

        foreach ($data['lines'] as $line) {
            $line['quote_id'] = $quote->id;
            $line['created_by'] = $user->id;
            $line['quote_line_status_id'] = QuoteLineStatusEnum::NOT_ACCEPTED->value;

            $quoteLine = QuoteLine::create($line);

            $line['quote_vehicle_id'] = $quoteVehicle->id;
            $line['quote_line_id'] = $quoteLine->id;

            $quoteVehicleLine = QuoteVehicleLine::create($line);
        }

        return $quoteVehicle;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
