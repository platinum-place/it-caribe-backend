<?php

namespace App\Filament\Resources\QuoteLifeResource\Pages;

use App\Filament\Resources\QuoteLifeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuoteLife extends EditRecord
{
    protected static string $resource = QuoteLifeResource::class;

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
