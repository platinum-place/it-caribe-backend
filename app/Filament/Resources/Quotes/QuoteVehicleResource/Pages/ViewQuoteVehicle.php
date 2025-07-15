<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Pages;

use App\Filament\Resources\QuoteResource;
use App\Filament\Resources\Quotes\QuoteVehicleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteVehicle extends ViewRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('download')
                ->translateLabel()
                ->url(route('filament.quote-vehicles.download', ['quote_vehicle' => $this->record]))
                ->openUrlInNewTab(),
        ];
    }
}
