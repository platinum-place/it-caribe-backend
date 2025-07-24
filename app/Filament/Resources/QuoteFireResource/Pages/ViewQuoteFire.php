<?php

namespace App\Filament\Resources\QuoteFireResource\Pages;

use App\Enums\QuoteStatus;
use App\Filament\Resources\QuoteFireResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuoteFire extends ViewRecord
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            //            Actions\Action::make('download')
            //                ->translateLabel()
            //                ->url(route('filament.quote-fires.download', ['quote_fire' => $this->record]))
            //                ->openUrlInNewTab()
            //                ->visible(fn () => $this->record->quote->quote_status_id !== QuoteStatus::APPROVED->value),
            //            Actions\Action::make('download')
            //                ->label(__('Download :name', ['name' => __('Issuance')]))
            //                ->url(route('filament.quote-fires.downloadCertificate', ['quote_fire' => $this->record]))
            //                ->openUrlInNewTab()
            //                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::APPROVED->value),
            Actions\Action::make('emit')
                ->translateLabel()
                ->url(route('filament.admin.resources.quote-fires.emit', ['record' => $this->record]))
                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::PENDING->value),
            Actions\Action::make('documents')
                ->label(__('Download :name', ['name' => __('Documents')]))
                ->url(function () {
                    $id = $this->record?->quote?->selectedLine?->id_crm;

                    return route('filament.zoho-crm.download-product-attachments', ['id' => $id]);
                })
                ->visible(fn () => $this->record->quote->quote_status_id === QuoteStatus::APPROVED->value),
        ];
    }
}
