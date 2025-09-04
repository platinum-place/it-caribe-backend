<?php

namespace Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\QuoteUnemploymentResource;

class ListQuoteUnemployments extends ListRecords
{
    protected static string $resource = QuoteUnemploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
