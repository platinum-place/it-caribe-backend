<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFireConstructionTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFireConstructionTypes\QuoteFireConstructionTypeResource;

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
