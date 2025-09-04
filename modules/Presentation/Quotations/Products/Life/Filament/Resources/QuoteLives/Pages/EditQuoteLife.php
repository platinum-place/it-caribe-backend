<?php

namespace Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\QuoteLifeResource;

class EditQuoteLife extends EditRecord
{
    protected static string $resource = QuoteLifeResource::class;

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
