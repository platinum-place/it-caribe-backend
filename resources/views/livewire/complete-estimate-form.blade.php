<div>
    @if ($this->show)
        <form wire:submit="create">
            {{ $this->form }}

            <br>

            <x-filament::button type="submit">
                {{ __('Submit') }}
            </x-filament::button>
        </form>

        <x-filament-actions::modals/>
    @endif
</div>
