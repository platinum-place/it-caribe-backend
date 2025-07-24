<?php

namespace App\Filament\Resources\QuoteFireResource\Pages;

use App\Filament\Resources\QuoteFireResource;
use App\Filament\Resources\QuoteLifeResource;
use Filament\Actions;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class EmitQuoteFire extends Page
{
    use InteractsWithRecord;

    protected static string $resource = QuoteFireResource::class;

    protected static string $view = 'filament.resources.quote-fire-resource.pages.emit-quote-fire';

    public string $returnUrl;

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->returnUrl = QuoteFireResource::getUrl('view', ['record' => $this->record->id]);
    }

    public static function getNavigationLabel(): string
    {
        return __('Emit').' '.__('Quote fire');
    }

    public function getHeading(): string
    {
        return __('Emit').' '.__('Quote fire');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view')
                ->translateLabel()
                ->color('gray')
                ->url(fn () => QuoteFireResource::getUrl('view', ['record' => $this->record->id])),
        ];
    }
}
