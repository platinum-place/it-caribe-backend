<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\QuoteLineResource;

class EditQuoteLine extends EditRecord
{
    protected static string $resource = QuoteLineResource::class;

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
