<?php

namespace App\Filament\Resources\Quote\QuoteLineStatuses\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use old\Filament\Resources\Quote\QuoteLineStatuses\QuoteLineStatusResource;

class EditQuoteLineStatus extends EditRecord
{
    protected static string $resource = QuoteLineStatusResource::class;

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
