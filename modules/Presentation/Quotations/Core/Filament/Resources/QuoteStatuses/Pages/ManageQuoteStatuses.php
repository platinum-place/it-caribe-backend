<?php

namespace Modules\Presentation\Quotations\Core\Filament\Resources\QuoteStatuses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Core\Filament\Resources\QuoteStatuses\QuoteStatusResource;

class ManageQuoteStatuses extends ManageRecords
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
