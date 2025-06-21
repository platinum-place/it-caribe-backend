<div>
    <div class="mt-6">
        <div
            class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-header px-6 py-4">
                <div class="flex items-center">
                    <div class="grid flex-1 gap-y-1">
                        <h3 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            Resultados de Cotización
                        </h3>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div
                    class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="p-4 sm:px-6">
                        <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            Planes Disponibles
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 dark:divide-white/5">
                            <thead class="bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white sm:ps-6">
                                    Aseguradoras
                                </th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white">
                                    Prima
                                </th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-950 dark:text-white sm:pe-6">
                                    Comentario
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                            @forelse($planes as $plan)
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5">
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-950 dark:text-white sm:ps-6">{{ $plan['aseguradora'] ?? '' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold text-success-600 dark:text-success-400">
                                        RD$ {{ number_format($plan['total'] ?? 0, 2) }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:pe-6">{{ $plan['comentario'] ?? '' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">No
                                        hay planes disponibles
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($this->canContinue())
                    <div class="mt-6 flex justify-end">
                        <x-filament::button wire:click="continue" color="primary">Continuar</x-filament::button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
