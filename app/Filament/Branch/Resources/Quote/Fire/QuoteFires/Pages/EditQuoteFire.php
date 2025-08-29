<?php

namespace App\Filament\Branch\Resources\Quote\Fire\QuoteFires\Pages;

use App\Filament\Branch\Resources\Quote\Fire\QuoteFires\QuoteFireResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditQuoteFire extends EditRecord
{
    protected static string $resource = QuoteFireResource::class;

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
