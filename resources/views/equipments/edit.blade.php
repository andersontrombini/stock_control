<form action="{{ route('equipments.update', $equipment->id) }}" method="POST" onsubmit="submitEquipmentForm(event)">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
        <input type="text" name="name" id="name" value="{{ $equipment->name }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    </div>

    <div class="mb-4">
        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantidade</label>
        <input type="number" name="quantity" id="quantity" value="{{ $equipment->quantity }}"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    </div>

    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="active" @selected($equipment->status === 'active')>Ativo</option>
            <option value="inactive" @selected($equipment->status === 'inactive')>Inativo</option>
        </select>
    </div>

    <x-primary-button>
        Salvar Alterações
    </x-primary-button>
</form>
