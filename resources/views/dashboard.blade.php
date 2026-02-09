<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Ações do topo -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('service_orders.export') }}"
                    class="inline-flex items-center px-4 py-2 
                          bg-green-600 hover:bg-green-700 
                          text-white font-semibold rounded-lg 
                          shadow-md transition">

                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 16v-8m0 8l-3-3m3 3l3-3M4 20h16" />
                    </svg>

                    Relatório Mensal
                </a>
            </div>

            <!-- Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">
                        📊 Serviços do Mês de {{ ucfirst($monthName) }}
                    </h2>

                    <!-- Container do gráfico -->
                    <div class="flex justify-center">
                        <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2">
                            <div class="relative h-96">
                                <canvas id="serviceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="text-right font-semibold mt-4">
                Total: {{ array_sum($servicesByType) }}
            </div>

        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const serviceData = @json(array_values($servicesByType));
        const serviceLabels = @json(array_map('service_type_label', array_keys($servicesByType)));

        new Chart(document.getElementById('serviceChart'), {
            type: 'doughnut',
            data: {
                labels: serviceLabels,
                datasets: [{
                    data: serviceData,
                    backgroundColor: [
                        '#6366F1', '#10B981', '#F59E0B', '#EF4444', '#3B82F6', '#8B5CF6'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Distribuição de Serviços por Tipo'
                    }
                }
            }
        });
    </script>
</x-app-layout>
