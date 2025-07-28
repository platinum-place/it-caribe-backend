<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class EmitQuote extends Page
{
    use InteractsWithRecord;

    protected static string $resource = QuoteResource::class;

    protected static string $view = 'filament.resources.quote-resource.pages.emit-quote';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public static function getNavigationLabel(): string
    {
        return __('Emit').' '.__('Quote');
    }

    public function getHeading(): string
    {
        return __('Emit').' '.__('Quote');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view')
                ->translateLabel()
                ->color('gray')
                ->url(fn () => QuoteResource::getUrl('view', ['record' => $this->record])),
        ];
    }
}
