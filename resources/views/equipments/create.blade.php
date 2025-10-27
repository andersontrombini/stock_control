<form id="equipmentForm" x-data @submit.prevent="submitEquipmentForm">
    @csrf
    <div class="space-y-4">
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="quantity" :value="__('Quantidade')" />
            <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="old('quantity')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button class="ms-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </div>
    </div>
</form>
