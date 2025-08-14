<?php

namespace App\Livewire;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Filament\Resources\QuoteResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Modules\Quote\Infrastructure\Persistance\Models\Quote;

class EmitQuote extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Quote $record;

    public function mount(Quote $record): void
    {
        $this->form->fill(['attachments' => $record?->quote?->attachments ?? []]);

        $this->record = $record;
    }

    public function form(Form $form): Form
    {
        $lines = $this->record->lines;

        $debtor = $this->record->debtor;

        return $form
            ->schema([
                Select::make('line')
                    ->label('Aseguradoras')
                    ->options(function () use ($lines) {
                        return $lines
                            ->where('total', '>', 0)
                            ->mapWithKeys(function ($line) {
                                return [$line->id => $line->name.' (RD$'.number_format($line->total / 12, 2).')'];
                            });
                    }),

                Checkbox::make('agreement')
                    ->label(fn () => new \Illuminate\Support\HtmlString(
                        'Estoy de acuerdo que quiero emitir la cotización, a nombre de <b>'.$debtor->fullName.'</b>, RNC/Cédula <b>'.$debtor->identity_number.'</b>'
                    ))
                    ->required()
                    ->columnSpanFull(),

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
//                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull(),
            ])
            ->columns()
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $quote = $this->record;
        $line = $quote->lines->where('id', $data['line'])->firstOrFail();

        $deadline = $this->record?->deadline;

        $quote->update([
            'attachments' => $data['attachments'] ?? [],
            'quote_status_id' => QuoteStatusEnum::APPROVED->value,
            'responsible_id' => auth()->id(),
            //            'end_date' => now()->addMonths($deadline ?? 12),
        ]);

        $line->update([
            'quote_line_status_id' => QuoteLineStatusEnum::ACCEPTED->value,
        ]);

        $this->redirect(QuoteResource::getUrl('view', ['record' => $this->record]));
    }

    public function render()
    {
        return view('livewire.emit-quote');
    }
}
