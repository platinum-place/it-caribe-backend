<div>
    <form wire:submit="create">
        {{ $this->form }}

        @if($selectedInsurance && $this->getDownloadUrl())
            <br>

            <div class="mb-4">
                <x-filament::button
                    tag="a"
                    :href="$this->getDownloadUrl()"
                    target="_blank"
                    color="gray"
                    icon="heroicon-o-arrow-down-tray"
                >
                    Descargar Condicionado
                </x-filament::button>
            </div>
        @endif

        <br>

        <x-filament::button type="submit">
            {{ __('Submit') }}
        </x-filament::button>
    </form>

    <x-filament-actions::modals/>
</div>
