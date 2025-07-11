<?php

namespace App\Filament\Resources\QuoteVehicleResource\Pages;

use App\Filament\Resources\QuoteResource;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteVehicle extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
