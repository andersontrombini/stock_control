<x-guest-layout>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-gray-900 dark:text-gray-100 font-sans">
        <h1 class="text-2xl font-bold mb-4 text-red-600 dark:text-red-400">
            ⚠️ ALERTA DE ESTOQUE BAIXO
        </h1>

        <p class="mb-4">
            Os seguintes equipamentos estão com estoque abaixo do limite definido:
        </p>

        <ul class="mb-4 space-y-2">
            @foreach ($equipments as $equipment)
                <li class="p-3 border border-red-300 dark:border-red-700 rounded">
                    <strong>{{ $equipment->name }}</strong><br>
                    Quantidade atual: {{ $equipment->formatted_quantity }}<br>
                    Limite mínimo: {{ $equipment->formatted_low_stock_threshold }}
                </li>
            @endforeach
        </ul>

        <p class="mb-4">
            Favor providenciar a reposição o mais breve possível para evitar interrupções no serviço.
        </p>

        <hr class="border-gray-200 dark:border-gray-700 my-4">

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Este é um e-mail automático. Não responda.
        </p>
    </div>
</x-guest-layout>
