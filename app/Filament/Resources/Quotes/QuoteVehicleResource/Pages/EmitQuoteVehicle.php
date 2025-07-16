<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Pages;

use App\Filament\Resources\Quotes\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class EmitQuoteVehicle extends Page
{
    use InteractsWithRecord;

    protected static string $resource = QuoteVehicleResource::class;

    protected static string $view = 'filament.resources.quotes.quote-vehicle-resource.pages.emit-quote-vehicle';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public static function getNavigationLabel(): string
    {
        return __('Emit').' '.__('Quote vehicle');
    }

    public function getHeading(): string
    {
        return __('Emit').' '.__('Quote vehicle');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
}
