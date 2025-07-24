<?php

namespace App\Filament\Resources\QuoteLifeResource\Pages;

use App\Filament\Resources\QuoteLifeResource;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class EmitQuoteLife extends Page
{
    use InteractsWithRecord;

    protected static string $resource = QuoteLifeResource::class;

    public string $returnUrl;

    protected static string $view = 'filament.resources.quote-life-resource.pages.emit-quote-life';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->returnUrl = QuoteLifeResource::getUrl('view', ['record' => $this->record->id]);
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
                ->url(fn () => QuoteLifeResource::getUrl('view', ['record' => $this->record->id])),
        ];
    }
}
