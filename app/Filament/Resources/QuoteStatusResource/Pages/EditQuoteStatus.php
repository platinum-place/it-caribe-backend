<?php

namespace App\Filament\Resources\QuoteStatusResource\Pages;

use App\Filament\Resources\QuoteStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuoteStatus extends EditRecord
{
    protected static string $resource = QuoteStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
