<x-app-layout>
    <!-- Importação correta do CSS do DataTables Tailwind -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">

    <div x-data="{ open: false, content: '', title: '' }" class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Botão de Inserir Registro -->
            <div class="flex justify-end mb-6">
                <x-primary-button type="button"
                    @click="
                title='Novo Serviço';
            open = true;
            fetch('{{ route('service_orders.create') }}')
                .then(res => res.text())
                .then(html => content = html)
        "
                    class="rounded-lg shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>

                    {{ __('Nova Ordem de Serviço') }}
                </x-primary-button>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">{{ __('Lista de Serviços') }}</h3>

                    <!-- Tabela Responsiva -->
                    <div class="overflow-x-auto">
                        @if ($serviceOrders->isEmpty())
                            <div class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Nenhum serviço registrado.') }}
                            </div>
                        @else
                            <table id="serviceOrderTable"
                                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Nome Cliente') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Endereço') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Plano') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Tipo') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Descrição') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Ações') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($serviceOrders as $serviceOrder)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $serviceOrder->client_name }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $serviceOrder->client_address }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $serviceOrder->client_plan }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ service_type_label($serviceOrder->type) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $serviceOrder->description }}
                                            </td>
                                            @php($status = service_status_badge($serviceOrder->status))
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $status['class'] }}">
                                                    {{ $status['label'] }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center gap-3">
                                                @if ($serviceOrder->status === 'closed')
                                                    <!-- Visualizar equipamentos -->
                                                    <button
                                                        @click="
                title='Equipamentos utilizados';
                open = true;
                fetch('{{ route('service_orders.equipments', $serviceOrder->id) }}')
                    .then(res => res.text())
                    .then(html => content = html)
            "
                                                        title="Equipamentos utilizados"
                                                        class="text-blue-500 hover:text-blue-700 
                   dark:text-blue-400 dark:hover:text-blue-300 
                   transition duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1.8">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.478 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.064 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                                <!-- Editar -->
                                                <button
                                                    @click="
            title='Editar Ordem de Serviço';
            open = true;
            fetch('{{ route('service_orders.edit', $serviceOrder->id) }}')
                .then(res => res.text())
                .then(html => content = html)
        "
                                                    title="Editar"
                                                    class="text-orange-500 hover:text-orange-700 
               dark:text-orange-400 dark:hover:text-orange-300 
               transition duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.25 2.25 0 113.182 3.182L7.125 20.588
                   3 21l.412-4.125L16.862 4.487z" />
                                                    </svg>
                                                </button>

                                                <!-- Excluir -->
                                                <button
                                                    onclick="confirmDelete('{{ route('service_orders.destroy', $serviceOrder->id) }}')"
                                                    title="Excluir"
                                                    class="text-red-500 hover:text-red-700 
               dark:text-red-400 dark:hover:text-red-300 
               transition duration-150">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                   a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1-3
                   h-4a1 1 0 00-1 1v1h6V5a1 1 0 00-1-1z" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!-- Fim da Tabela -->
                </div>
            </div>

            <div x-show="open" x-transition
                class="fixed inset-y-0 right-0 w-full sm:w-2/3 lg:w-1/3 
           bg-white dark:bg-gray-800 shadow-2xl 
           border-l border-orange-200 dark:border-orange-700 
           z-50 overflow-y-auto">

                <div
                    class="flex justify-between items-center p-4 
                border-b border-orange-200 dark:border-orange-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100" x-text="title">

                    </h2>

                    <button @click="open = false"
                        class="text-orange-400 hover:text-orange-600 
                   dark:text-orange-400 dark:hover:text-orange-300 
                   text-2xl leading-none">
                        &times;
                    </button>
                </div>

                <!-- Loading -->
                <div class="p-6 min-h-[300px]" x-show="!content">
                    <div class="flex justify-center items-center h-full">
                        <svg class="animate-spin h-8 w-8 text-orange-500" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </div>
                </div>

                <div class="p-6" x-html="content"></div>
            </div>


            <!-- Overlay escurecido -->
            <div x-show="open" x-transition.opacity @click="open = false"
                class="fixed inset-0 bg-black bg-opacity-40 z-40">
            </div>
        </div>



        <!-- Scripts DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('#serviceOrderTable').DataTable({
                    order: [],
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/pt-BR.json'
                    },
                    responsive: true,
                    pagingType: 'full_numbers',
                    dom: "<'flex justify-between items-center mb-4'<'text-sm'l><'flex space-x-2'f>>" +
                        "<'overflow-x-auto'tr>" +
                        "<'flex justify-end mt-4'p>",
                    initComplete: function() {
                        // adiciona classes Tailwind ao select do length menu
                        $('select[name="serviceOrderTable_length"]').addClass(
                            'form-select w-24 px-2 py-1 border rounded');
                    }
                });
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-lg shadow-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-100',
                    title: 'font-semibold',
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            async function submitServiceOrderForm(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);
                const action = form.getAttribute('action') || "{{ route('service_orders.store') }}";

                const button = form.querySelector('button[type="submit"]');
                if (button) {
                    button.disabled = true;
                    button.textContent = 'Salvando...';
                }

                try {
                    const response = await fetch(action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Ordem de serviço salva com sucesso!'
                        });
                        setTimeout(() => window.location.reload(), 1500);
                    } else if (response.status === 422) {
                        const data = await response.json();
                        showValidationErrors(form, data.errors);

                        Toast.fire({
                            icon: 'warning',
                            title: 'Há erros no formulário!'
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro ao salvar a ordem de serviço.'
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Toast.fire({
                        icon: 'error',
                        title: 'Falha na requisição.'
                    });
                } finally {
                    if (button) {
                        button.disabled = false;
                        button.textContent = 'Salvar';
                    }
                }
            }

            // Função para exibir erros nos campos
            function showValidationErrors(form, errors) {
                // limpa erros antigos
                form.querySelectorAll('.text-red-500').forEach(el => el.remove());

                for (const [field, messages] of Object.entries(errors)) {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        const error = document.createElement('p');
                        error.className = 'text-red-500 text-sm mt-1';
                        error.textContent = messages.join(', ');
                        input.insertAdjacentElement('afterend', error);
                    }
                }
            }

            async function confirmDelete(url) {
                const result = await Swal.fire({
                    title: 'Tem certeza?',
                    text: "Essa ação não poderá ser desfeita.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir',
                    cancelButtonText: 'Cancelar'
                });

                if (!result.isConfirmed) return;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new URLSearchParams({
                            '_method': 'DELETE'
                        })
                    });

                    if (response.ok) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Ordem de serviço excluída com sucesso!'
                        });
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Erro ao excluir a ordem de serviço.'
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Toast.fire({
                        icon: 'error',
                        title: 'Falha na requisição.'
                    });
                }
            }
        </script>
</x-app-layout>
