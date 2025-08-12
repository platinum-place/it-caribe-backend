<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\QuoteStatusResource;

class EditQuoteStatus extends EditRecord
{
    protected static string $resource = QuoteStatusResource::class;

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
