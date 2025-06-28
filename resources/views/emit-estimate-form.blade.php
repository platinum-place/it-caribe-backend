<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emitir Cotización</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Emitir Cotización</h1>

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

        <form action="{{ route('emit-estimate.store', $id) }}" method="POST" enctype="multipart/form-data" id="emitForm">
            @csrf

            <!-- Selección de Aseguradora -->
            <div class="mb-6">
                <label for="planid" class="block text-sm font-medium text-gray-700 mb-2">
                    Aseguradora *
                </label>
                <select 
                    name="planid" 
                    id="planid" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                    onchange="updateDownloadLink()"
                >
                    <option value="">Seleccione una aseguradora</option>
                    @foreach($insuranceOptions as $id => $label)
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
            <div class="mb-6">
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
                    <label for="acuerdo" class="ml-2 text-sm text-gray-700">
                        Estoy de acuerdo que quiero emitir la cotización, a nombre de 
                        <strong>{{ $customerName }}</strong>, RNC/Cédula 
                        <strong>{{ $customerDocument }}</strong> *
                    </label>
                </div>
                @error('acuerdo')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo de Archivos -->
            <div class="mb-6">
                <label for="documentos" class="block text-sm font-medium text-gray-700 mb-2">
                    Adjuntar documentos *
                </label>
                <input 
                    type="file" 
                    id="documentos"
                    name="documentos[]" 
                    multiple 
                    accept=".pdf,.jpg,.jpeg,.png,.gif"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    required
                    onchange="showSelectedFiles()"
                >
                @error('documentos.*')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
                
                <!-- Mostrar archivos seleccionados -->
                <div id="selectedFiles" class="mt-2 hidden">
                    <p class="text-sm text-gray-600">Archivos seleccionados:</p>
                    <ul id="filesList" class="text-xs text-gray-500"></ul>
                </div>
            </div>

            <!-- Botón de Descarga Condicionado -->
            <div id="downloadSection" class="mb-6 hidden">
                <a 
                    id="downloadLink" 
                    href="#" 
                    target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Descargar Condicionado
                </a>
            </div>

            <!-- Botón de Envío -->
            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Emitir Cotización
                </button>
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
</body>
</html>
