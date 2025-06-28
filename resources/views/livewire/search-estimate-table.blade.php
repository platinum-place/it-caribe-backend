<div>
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <!-- Header con búsqueda -->
        <div class="fi-section-header px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="grid flex-1 gap-y-1">
                    <h3 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        Cotizaciones
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total: {{ $total }} cotizaciones
                    </p>
                </div>

                <!-- Buscador -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500"
                            placeholder="Buscar cotizaciones..."
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200 dark:divide-white/5">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white sm:ps-6">
                                Fecha Cotización
                            </th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white">
                                Código
                            </th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white">
                                Cliente
                            </th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white">
                                RNC/Cédula
                            </th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white">
                                Plan
                            </th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white">
                                Referidor
                            </th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white sm:pe-6">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-white/5 bg-white dark:bg-gray-900">
                        @forelse($paginatedCotizaciones as $cotizacion)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors duration-200">
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-950 dark:text-white sm:ps-6">
                                    {{ $cotizacion['Created_Time'] ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-950 dark:text-white">
                                    <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-700/10 dark:bg-amber-400/10 dark:text-amber-400 dark:ring-amber-400/20">
                                        {{ $cotizacion['id'] ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-950 dark:text-white">
                                    <div class="font-medium">{{ $cotizacion['Nombre'] ?? '-'.$cotizacion['Apellido'] ?? '-' }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $cotizacion['RNC_C_dula'] ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-950 dark:text-white">
                                    {{ $cotizacion['Plan'] ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $cotizacion['Contact_Name']['name'] ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-950 dark:text-white sm:pe-6">
                                    <div class="flex items-center gap-2">
                                        @if(isset($cotizacion['id']))
                                            <a href="{{ \App\Filament\Pages\Estimate::getUrl(['id' => $cotizacion['id']]) }}"
                                               title="Emitir"
                                               class="inline-flex items-center justify-center w-8 h-8 text-gray-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors duration-200 dark:text-gray-400 dark:hover:text-amber-400 dark:hover:bg-amber-400/10">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </a>

{{--                                            <a href="{{ $cotizacion['editar_url'] ?? '#' }}"--}}
{{--                                               title="Editar"--}}
{{--                                               class="inline-flex items-center justify-center w-8 h-8 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200 dark:text-gray-400 dark:hover:text-blue-400 dark:hover:bg-blue-400/10">--}}
{{--                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}

                                            <a href="{{ route('filament.resources.estimate.download', ['id' => $cotizacion['id']]) }}"
                                               title="Descargar"
                                               target="_blank"
                                               class="inline-flex items-center justify-center w-8 h-8 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200 dark:text-gray-400 dark:hover:text-green-400 dark:hover:bg-green-400/10">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-12 text-center text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <p class="text-lg font-medium text-gray-900 dark:text-white mb-1">No hay cotizaciones</p>
                                        <p class="text-gray-500 dark:text-gray-400">
                                            @if($search)
                                                No se encontraron cotizaciones que coincidan con "{{ $search }}"
                                            @else
                                                No hay cotizaciones disponibles para mostrar
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        @if($totalPages > 1)
            <div class="fi-section-footer px-6 py-4 border-t border-gray-200 dark:border-white/5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <span>
                            Mostrando {{ ($this->getPage() - 1) * $perPage + 1 }} -
                            {{ min($this->getPage() * $perPage, $total) }} de {{ $total }} resultados
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Botón Anterior -->
                        <button
                            wire:click="previousPage"
                            @if($this->getPage() <= 1) disabled @endif
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Anterior
                        </button>

                        <!-- Números de página -->
                        <div class="flex items-center gap-1">
                            @php
                                $currentPage = $this->getPage();
                                $totalPages = $this->totalPages;
                                $start = max(1, $currentPage - 2);
                                $end = min($totalPages, $currentPage + 2);
                            @endphp

                            @if($start > 1)
                                <button
                                    wire:click="gotoPage(1)"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    1
                                </button>
                                @if($start > 2)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                <button
                                    wire:click="gotoPage({{ $i }})"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm font-medium rounded-lg border
                                        @if($i == $currentPage)
                                            text-white bg-amber-600 border-amber-600 hover:bg-amber-700
                                        @else
                                            text-gray-500 bg-white border-gray-300 hover:bg-gray-50 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
                                        @endif
                                    "
                                >
                                    {{ $i }}
                                </button>
                            @endfor

                            @if($end < $totalPages)
                                @if($end < $totalPages - 1)
                                    <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                                @endif
                                <button
                                    wire:click="gotoPage({{ $totalPages }})"
                                    class="inline-flex items-center justify-center w-8 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    {{ $totalPages }}
                                </button>
                            @endif
                        </div>

                        <!-- Botón Siguiente -->
                        <button
                            wire:click="nextPage"
                            @if($this->getPage() >= $totalPages) disabled @endif
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            Siguiente
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
