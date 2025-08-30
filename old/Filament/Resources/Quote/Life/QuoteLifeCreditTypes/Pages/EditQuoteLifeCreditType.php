<?php

namespace App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages;

use old\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\QuoteLifeCreditTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteLifeCreditType extends EditRecord
{
    protected static string $resource = QuoteLifeCreditTypeResource::class;

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
