<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatusResource;

class EditQuoteLineStatus extends EditRecord
{
    protected static string $resource = QuoteLineStatusResource::class;

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
