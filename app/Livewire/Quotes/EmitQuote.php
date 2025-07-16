<?php

namespace App\Livewire\Quotes;

use App\Models\Quotes\QuoteVehicle;
use Filament\Forms\Components\Checkbox;
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

    public QuoteVehicle $quote;

    public function mount(QuoteVehicle $quote): void
    {
        $this->form->fill();

        $this->quote = $quote;
    }

    public function form(Form $form): Form
    {
        $lines = $this->quote->quote->lines;

        $customer = $this->quote->quote->customer;

        return $form
            ->schema([
                Select::make('product')
                    ->label('Aseguradoras')
                    ->options(function () use ($lines) {
                        return $lines
                            ->where('total', '>', 0)
                            ->mapWithKeys(function ($line) {
                                return [$line->id => $line->name . ' (RD$' . number_format($line->total, 2) . ')'];
                            });
                    }),

                Checkbox::make('acuerdo')
                    ->label(fn () => new \Illuminate\Support\HtmlString(
                        'Estoy de acuerdo que quiero emitir la cotización, a nombre de <b>'. $customer->fullName.'</b>, RNC/Cédula <b>'. $customer->identity_number.'</b>'
                    ))
                    ->live()
                    ->required(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.quotes.emit-quote');
    }
}
