<?php

namespace Modules\Presentation\Quotations\Core\Filament\Resources\QuoteTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Core\Filament\Resources\QuoteTypes\QuoteTypeResource;

class ManageQuoteTypes extends ManageRecords
{
    protected static string $resource = QuoteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
