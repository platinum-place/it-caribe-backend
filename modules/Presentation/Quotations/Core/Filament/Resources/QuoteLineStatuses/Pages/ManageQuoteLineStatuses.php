<?php

namespace Modules\Presentation\Quotations\Core\Filament\Resources\QuoteLineStatuses\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Modules\Presentation\Quotations\Core\Filament\Resources\QuoteLineStatuses\QuoteLineStatusResource;

class ManageQuoteLineStatuses extends ManageRecords
{
    protected static string $resource = QuoteLineStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
