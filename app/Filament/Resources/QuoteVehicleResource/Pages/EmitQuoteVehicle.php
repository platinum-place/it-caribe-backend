<?php

namespace App\Filament\Resources\QuoteVehicleResource\Pages;

use App\Filament\Resources\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class EmitQuoteVehicle extends Page
{
    use InteractsWithRecord;

    protected static string $resource = QuoteVehicleResource::class;

    protected static string $view = 'filament.resources.quote-vehicle-resource.pages.emit-quote-vehicle';

    public string $returnUrl;

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->returnUrl = QuoteVehicleResource::getUrl('view', ['record' => $this->record->id]);
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
            Actions\Action::make('view')
                ->translateLabel()
                ->color('gray')
                ->url(fn () => QuoteVehicleResource::getUrl('view', ['record' => $this->record->id])),
        ];
    }
}
