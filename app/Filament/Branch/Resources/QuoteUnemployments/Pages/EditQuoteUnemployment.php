<?php

namespace App\Filament\Branch\Resources\QuoteUnemployments\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Branch\Resources\QuoteUnemployments\QuoteUnemploymentResource;

class EditQuoteUnemployment extends EditRecord
{
    protected static string $resource = QuoteUnemploymentResource::class;

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
