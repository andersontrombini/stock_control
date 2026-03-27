<form action="{{ route('technicals.update', $serviceOrder->id) }}" method="POST" onsubmit="submitServiceOrderForm(event)">
    @csrf
    @method('PUT')

    <div class="mb-6 space-y-2">
        <p class="text-sm"><strong>Cliente:</strong> {{ $serviceOrder->client_name }}</p>
        <p class="text-sm"><strong>OS Nº:</strong> #{{ $serviceOrder->id }}</p>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
        <h4 class="font-semibold text-md mb-4 text-indigo-600 dark:text-indigo-400 uppercase tracking-wider text-xs">Materiais Utilizados</h4>
        
        <div x-data="{ rows: [{ id: Date.now() }] }">
            <template x-for="(row, index) in rows" :key="row.id">
                <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded-lg mb-3 relative border border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Item do Estoque</label>
                            <select name="equipment_id[]" class="w-full text-sm rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 shadow-sm focus:ring-indigo-500">
                                <option value="">Selecione o material...</option>
                                @foreach($equipments as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} (Disponível: {{ $item->quantity }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Quantidade Utilizada</label>
                            <input type="number" name="quantity_used[]" min="1" class="w-full text-sm rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 shadow-sm focus:ring-indigo-500">
                        </div>
                    </div>
                    
                    <button type="button" @click="rows = rows.filter(r => r.id !== row.id)" 
                            class="absolute -top-2 -right-2 bg-red-100 text-red-600 rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-200 transition"
                            x-show="rows.length > 1">
                        &times;
                    </button>
                </div>
            </template>

            <button type="button" @click="rows.push({ id: Date.now() })" 
                    class="mt-2 inline-flex items-center text-xs font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-tighter">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                Adicionar outro material
            </button>
        </div>
    </div>

    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Atualizar Status da OS</label>
        <select name="status" class="w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 shadow-sm focus:ring-indigo-500">
            <option value="in_progress" {{ $serviceOrder->status == 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
            <option value="closed" {{ $serviceOrder->status == 'closed' ? 'selected' : '' }}>Finalizar (Concluído)</option>
        </select>
    </div>

    <div class="mt-8">
        <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-lg py-3 px-4 font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-lg text-xs">
            Salvar Baixa e Atualizar
        </button>
    </div>
</form>