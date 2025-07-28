<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Enums\QuoteStatus;
use App\Filament\Resources\QuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
//            Actions\Action::make('download')
//                ->translateLabel()
//                ->url(route('filament.quotes.download', ['quote_vehicle' => $this->record]))
//                ->openUrlInNewTab()
//                ->visible(fn () => $this->record->quote->quote_status_id !== QuoteStatus::APPROVED->value),
//            Actions\Action::make('download')
//                ->label(__('Download :name', ['name' => __('Issuance')]))
//                ->url(route('filament.quotes.downloadCertificate', ['quote_vehicle' => $this->record]))
//                ->openUrlInNewTab()
//                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::APPROVED->value),
//            Actions\Action::make('emit')
//                ->translateLabel()
//                ->url(route('filament.admin.resources.quotes.emit', ['record' => $this->record]))
//                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::PENDING->value),
//            Actions\Action::make('documents')
//                ->label(__('Download :name', ['name' => __('Documents')]))
//                ->url(function () {
//                    $id = $this->record?->quote?->selectedLine?->id_crm;
//
//                    return route('filament.zoho-crm.download-product-attachments', ['id' => $id]);
//                })
//                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::APPROVED->value),

        ];
    }
}
