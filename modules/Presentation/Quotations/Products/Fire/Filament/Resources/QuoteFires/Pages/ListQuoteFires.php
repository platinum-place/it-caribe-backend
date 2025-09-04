<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\QuoteFireResource;

class ListQuoteFires extends ListRecords
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
