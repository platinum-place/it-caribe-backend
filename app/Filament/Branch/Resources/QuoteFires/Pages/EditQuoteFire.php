<?php

namespace App\Filament\Branch\Resources\QuoteFires\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Branch\Resources\QuoteFires\QuoteFireResource;

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
