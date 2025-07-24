<?php

namespace App\Filament\Resources\QuoteFireResource\Pages;

use App\Filament\Resources\QuoteFireResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditQuoteFire extends EditRecord
{
    protected static string $resource = QuoteFireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('attachments')
                    ->translateLabel()
                    ->disk('local')
                    ->directory(fn () => 'quotes'.'/'.$this->record->id)
                    ->visibility('private')
                    ->multiple()
                    ->maxParallelUploads(1)
                    ->preserveFilenames()
                    ->reorderable()
                    ->appendFiles()
                    ->downloadable()
                    ->moveFiles()
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull()
                    ->dehydrated(false),
            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['attachments'] = $this->record->quote?->attachments ?? [];

        return $data;
    }

    protected function afterSave(): void
    {
        $attachments = $this->data['attachments'] ?? [];

        $this->record->quote->update([
            'attachments' => $attachments,
        ]);
    }
}
