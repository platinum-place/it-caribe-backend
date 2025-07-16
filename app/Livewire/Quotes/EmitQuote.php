<?php

namespace App\Livewire\Quotes;

use App\Enums\Quotes\QuoteLineStatus;
use App\Enums\Quotes\QuoteStatus;
use App\Filament\Pages\Emit;
use App\Filament\Resources\Quotes\QuoteVehicleResource;
use App\Helpers\Cotizaciones;
use App\Models\Quotes\QuoteVehicle;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\Select;

class EmitQuote extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public QuoteVehicle $record;

    public function mount(QuoteVehicle $record): void
    {
        $this->form->fill([
            'attachments' => $record?->quote?->attachments ?? [],
        ]);

        $this->record = $record;
    }

    public function form(Form $form): Form
    {
        $lines = $this->record->quote->lines;

        $customer = $this->record->quote->customer;

        return $form
            ->schema([
                Select::make('line')
                    ->label('Aseguradoras')
                    ->live()
                    ->options(function () use ($lines) {
                        return $lines
                            ->where('total', '>', 0)
                            ->mapWithKeys(function ($line) {
                                return [$line->id => $line->name . ' (RD$' . number_format($line->total, 2) . ')'];
                            });
                    }),

                Actions::make([
                    Action::make('documents')
                        ->label(__('Download :name', ['name' => __('Documents')]))
                        ->openUrlInNewTab()
                        ->url(function ($get) use ($lines) {
                            $id = $lines->where('id', $get('line'))->first()?->id_crm;

                            return route('filament.zoho-crm.download-product-attachments', ['id' => $id]);
                        })
                        ->visible(fn($get) => $get('line') !== null),
                ])
                    ->extraAttributes(['class' => 'flex items-end']),

                Checkbox::make('agreement')
                    ->label(fn() => new \Illuminate\Support\HtmlString(
                        'Estoy de acuerdo que quiero emitir la cotización, a nombre de <b>' . $customer->fullName . '</b>, RNC/Cédula <b>' . $customer->identity_number . '</b>'
                    ))
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('attachments')
                    ->translateLabel()
                    ->disk('local')
                    ->directory(fn() => 'quotes' . '/' . $this->record->id)
                    ->visibility('private')
                    ->multiple()
                    ->maxParallelUploads(1)
                    ->preserveFilenames()
                    ->reorderable()
                    ->appendFiles()
                    ->downloadable()
                    ->moveFiles()
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull(),
            ])
            ->columns()
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $quote = $this->record->quote;
        $line = $quote->lines->where('id', $data['line'])->first();

        $quote->update([
            'attachments' => $data['attachments'] ?? [],
            'quote_status_id' => QuoteStatus::APPROVED->value,
        ]);

        $line->update([
            'quote_line_status_id' => QuoteLineStatus::ACCEPTED->value
        ]);

        $libreria = new Cotizaciones;

        $cotizacion = $libreria->getRecord('Quotes', $quote->id_crm);

        $libreria->actualizar_cotizacion($cotizacion, $line->id_crm);

        $this->redirect(QuoteVehicleResource::getUrl('view', ['record' => $this->record->id]));
    }

    public function render()
    {
        return view('livewire.quotes.emit-quote');
    }
}
