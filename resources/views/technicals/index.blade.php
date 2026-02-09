<x-app-layout>
    <div x-data="{ open: false, content: '' }" class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-6">
                        {{ __('Minhas Ordens de Serviço') }}
                    </h3>

                    {{-- ===================== --}}
                    {{-- 📱 MOBILE - CARDS --}}
                    {{-- ===================== --}}
                    <div class="sm:hidden space-y-4">
                        @forelse ($serviceOrders as $os)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">

                                <div class="mb-2">
                                    <p class="text-xs font-bold uppercase text-gray-500">Cliente</p>
                                    <p class="text-sm font-medium">{{ $os->client_name }}</p>
                                </div>

                                <div class="mb-2">
                                    <p class="text-xs font-bold uppercase text-gray-500">Endereço</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ $os->client_address }}
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <p class="text-xs font-bold uppercase text-gray-500">Tipo</p>
                                    <p class="text-sm font-medium">
                                        {{ service_type_label($os->type) }}
                                    </p>
                                </div>

                                <button
                                    @click="
                                        open = true;
                                        content = '';
                                        fetch('{{ route('technicals.edit', $os->id) }}')
                                            .then(res => res.text())
                                            .then(html => content = html)
                                    "
                                    class="w-full inline-flex justify-center items-center
                                           px-4 py-2 bg-indigo-600 text-white
                                           rounded-md font-semibold text-sm
                                           hover:bg-indigo-700 transition shadow">
                                    Baixar materiais
                                </button>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500 italic">
                                Nenhuma ordem de serviço pendente.
                            </p>
                        @endforelse
                    </div>

                    {{-- ===================== --}}
                    {{-- 🖥️ DESKTOP - TABELA --}}
                    {{-- ===================== --}}
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Endereço
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-bold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($serviceOrders as $os)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 text-sm">
                                            {{ $os->client_name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $os->client_address }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ service_type_label($os->type) }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button
                                                @click="
                                                    open = true;
                                                    content = '';
                                                    fetch('{{ route('technicals.edit', $os->id) }}')
                                                        .then(res => res.text())
                                                        .then(html => content = html)
                                                "
                                                class="inline-flex items-center px-3 py-1.5
                                                       bg-indigo-600 text-white rounded
                                                       text-xs font-semibold uppercase
                                                       hover:bg-indigo-700 transition shadow">
                                                Baixar
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-10 text-center text-sm text-gray-500 italic">
                                            Nenhuma ordem de serviço pendente.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            {{-- ===================== --}}
            {{-- 🧩 PAINEL LATERAL --}}
            {{-- ===================== --}}
            <div x-show="open"
                x-transition:enter="transform transition ease-in-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed inset-y-0 right-0 w-full sm:w-2/3 lg:w-1/3
                       bg-white dark:bg-gray-800 shadow-2xl
                       border-l border-gray-200 dark:border-gray-700
                       z-50 overflow-y-auto"
                style="display: none;">

                <div
                    class="flex justify-between items-center p-4
                           border-b border-gray-200 dark:border-gray-700
                           sticky top-0 bg-white dark:bg-gray-800 z-10">
                    <h2 class="text-lg font-semibold">Baixar Materiais</h2>
                    <button @click="open = false"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 text-2xl leading-none">
                        &times;
                    </button>
                </div>

                <div class="p-6" x-show="!content">
                    <div class="flex justify-center items-center h-24">
                        <svg class="animate-spin h-6 w-6 text-indigo-600" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </div>
                </div>

                <div class="p-6" x-html="content"></div>
            </div>

            {{-- Overlay --}}
            <div x-show="open" x-transition.opacity @click="open = false"
                class="fixed inset-0 bg-black bg-opacity-40 z-40" style="display: none;"></div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- 🔔 SCRIPTS --}}
    {{-- ===================== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });

        async function submitServiceOrderForm(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const action = form.getAttribute('action');
            const button = form.querySelector('button[type="submit"]');

            if (button) {
                button.disabled = true;
                button.textContent = 'Processando...';
            }

            try {
                const response = await fetch(action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                if (response.ok) {
                    Toast.fire({ icon: 'success', title: 'Baixa realizada com sucesso!' });
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    const data = await response.json();
                    Toast.fire({ icon: 'error', title: data.message || 'Erro ao processar baixa.' });
                }
            } catch (error) {
                Toast.fire({ icon: 'error', title: 'Falha na requisição.' });
            } finally {
                if (button) {
                    button.disabled = false;
                    button.textContent = 'Salvar Baixa';
                }
            }
        }
    </script>
</x-app-layout>
