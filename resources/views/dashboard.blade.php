<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">
                        📊 Serviços do Mês de {{ ucfirst($monthName) }}
                    </h2>

                    <!-- Container do gráfico -->
                    <div class="flex justify-center">
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <canvas id="serviceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end font-semibold mt-4 mr-8">
            Total: {{ array_sum($servicesByType) }}
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
                maintainAspectRatio: false, // Permite ajustar o tamanho via CSS
                plugins: {
                    legend: { position: 'bottom' },
                    title: {
                        display: true,
                        text: 'Distribuição de Serviços por Tipo'
                    }
                }
            }
        });
    </script>
</x-app-layout>
