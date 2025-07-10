<?php

namespace App\Filament\Resources\QuoteTypeResource\Pages;

use App\Filament\Resources\QuoteTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuoteType extends EditRecord
{
    protected static string $resource = QuoteTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
