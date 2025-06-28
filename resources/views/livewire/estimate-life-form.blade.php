<div>
    <form wire:submit="create">
        {{ $this->form }}

        <br>

        <x-filament::button type="submit">
            {{ __('Estimate') }}
        </x-filament::button>
    </form>

    <x-filament-actions::modals/>
</div>
