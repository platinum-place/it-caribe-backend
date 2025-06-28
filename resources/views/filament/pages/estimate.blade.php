<x-filament-panels::page>
    <div class="max-w-2xl">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('emit-estimate.store', $this->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Selección de Aseguradora -->
            <div>
                <label for="planid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Aseguradora *
                </label>
                <select
                    name="planid"
                    id="planid"
                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                    required
                    onchange="updateDownloadLink()"
                >
                    <option value="">Seleccione una aseguradora</option>
                    @foreach($this->getInsuranceOptions() as $id => $label)
                        <option value="{{ $id }}" {{ old('planid') == $id ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('planid')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Checkbox de Acuerdo -->
            <div>
                <div class="flex items-start">
                    <input
                        type="checkbox"
                        name="acuerdo"
                        id="acuerdo"
                        value="1"
                        class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        required
                        {{ old('acuerdo') ? 'checked' : '' }}
                    >
                    <label for="acuerdo" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                        Estoy de acuerdo que quiero emitir la cotización, a nombre de
                        <strong>{{ $this->getCustomerName() }}</strong>, RNC/Cédula
                        <strong>{{ $this->getCustomerDocument() }}</strong> *
                    </label>
                </div>
                @error('acuerdo')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo de Archivos -->
            <div>
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
                    onchange="showSelectedFiles()"
                >
                @error('documentos.*')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror

                <!-- Mostrar archivos seleccionados -->
                <div id="selectedFiles" class="mt-2 hidden">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Archivos seleccionados:</p>
                    <ul id="filesList" class="text-xs text-gray-500 dark:text-gray-400"></ul>
                </div>
            </div>

            <!-- Botón de Descarga Condicionado -->
            <div id="downloadSection" class="hidden">
                <x-filament::button
                    tag="a"
                    id="downloadLink"
                    href="#"
                    target="_blank"
                    color="gray"
                    icon="heroicon-o-arrow-down-tray"
                >
                    Descargar Condicionado
                </x-filament::button>
            </div>

            <!-- Botón de Envío -->
            <div class="flex justify-end">
                <x-filament::button type="submit">
                    Emitir Cotización
                </x-filament::button>
            </div>
        </form>
    </div>

    <script>
        function showSelectedFiles() {
            const input = document.getElementById('documentos');
            const filesDiv = document.getElementById('selectedFiles');
            const filesList = document.getElementById('filesList');

            if (input.files.length > 0) {
                filesDiv.classList.remove('hidden');
                filesList.innerHTML = '';

                Array.from(input.files).forEach(file => {
                    const li = document.createElement('li');
                    li.textContent = `• ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                    filesList.appendChild(li);
                });
            } else {
                filesDiv.classList.add('hidden');
            }
        }

        function updateDownloadLink() {
            const select = document.getElementById('planid');
            const downloadSection = document.getElementById('downloadSection');
            const downloadLink = document.getElementById('downloadLink');

            if (select.value) {
                const url = `{{ route('filament.resources.estimate.condicionado', ':planId') }}`.replace(':planId', select.value);
                downloadLink.href = url;
                downloadSection.classList.remove('hidden');
            } else {
                downloadSection.classList.add('hidden');
            }
        }
    </script>
</x-filament-panels::page>
