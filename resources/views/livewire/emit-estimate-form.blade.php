<div>
    <form wire:submit="create" enctype="multipart/form-data">
        {{ $this->form }}

        <br>

        <!-- Campo de archivos HTML básico -->
        <div class="mb-4">
            <label for="documentos" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Adjuntar documentos *
            </label>
            <input
                type="file"
                id="documentos"
                name="documentos[]"
                multiple
                accept=".pdf,.jpg,.jpeg,.png,.gif"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600"
                required
            >
            @if(session('error'))
                <span class="text-red-500 text-xs mt-1">{{ session('error') }}</span>
            @endif
            @error('documentos.*')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

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
