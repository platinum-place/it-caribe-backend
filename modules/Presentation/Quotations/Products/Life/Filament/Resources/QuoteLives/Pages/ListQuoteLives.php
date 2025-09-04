<?php

namespace Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\QuoteLifeResource;

class ListQuoteLives extends ListRecords
{
    protected static string $resource = QuoteLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
