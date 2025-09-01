<?php

namespace App\Filament\Resources\QuoteFireConstructionTypes\Pages;

use App\Filament\Resources\QuoteFireConstructionTypes\QuoteFireConstructionTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuoteFireConstructionTypes extends ManageRecords
{
    protected static string $resource = QuoteFireConstructionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
