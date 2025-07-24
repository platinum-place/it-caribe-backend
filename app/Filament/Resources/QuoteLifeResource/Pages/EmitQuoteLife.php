<?php

namespace App\Filament\Resources\QuoteLifeResource\Pages;

use App\Filament\Resources\QuoteLifeResource;
use App\Filament\Resources\QuoteVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class EmitQuoteLife extends Page
{
    use InteractsWithRecord;

    protected static string $resource = QuoteLifeResource::class;

    protected static string $view = 'filament.resources.quote-life-resource.pages.emit-quote-life';

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
            Actions\Action::make('view')
                ->translateLabel()
                ->color('gray')
                ->url(fn () => QuoteVehicleResource::getUrl('view', ['record' => $this->record->id])),
        ];
    }
}
