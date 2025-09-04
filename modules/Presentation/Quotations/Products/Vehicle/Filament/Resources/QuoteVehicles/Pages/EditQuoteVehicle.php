<?php

namespace Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources\QuoteVehicles\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Presentation\Quotations\Products\Vehicle\Filament\Resources\QuoteVehicles\QuoteVehicleResource;

class EditQuoteVehicle extends EditRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
