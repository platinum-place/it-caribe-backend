<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatusResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatusResource;

class EditQuoteStatus extends EditRecord
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
