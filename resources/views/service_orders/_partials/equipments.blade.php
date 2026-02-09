<h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">
    Equipamentos utilizados
</h3>

<p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
    Ordem #{{ $serviceOrder->id }} — {{ $serviceOrder->client_name }}
</p>

@if ($equipments->isEmpty())
    <p class="text-sm text-gray-500 dark:text-gray-400">
        Nenhum equipamento registrado para esta ordem.
    </p>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium uppercase">
                        Equipamento
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-medium uppercase">
                        Quantidade
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($equipments as $equipment)
                    <tr>
                        <td class="px-4 py-2 text-sm">
                            {{ $equipment->name }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            {{ $equipment->pivot->quantity_used }}
                            @if ($equipment->is_measured_in_meters)
                                M
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
