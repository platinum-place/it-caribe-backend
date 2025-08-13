<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicles\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\CRM\Infrastructure\Persistence\Models\Debtor;
use Modules\Quote\Domain\Enums\QuoteLineStatusEnum;
use Modules\Quote\Domain\Enums\QuoteStatusEnum;
use Modules\Quote\Domain\Enums\QuoteTypeEnum;
use Modules\Quote\Infrastructure\Persistence\Models\Quote;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLine;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models\QuoteVehicle;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models\QuoteVehicleLine;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicles\QuoteVehicleResource;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Infrastructure\Persistence\Models\Vehicle;

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
