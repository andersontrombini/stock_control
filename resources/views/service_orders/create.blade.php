<form id="serviceOrderForm" x-data @submit.prevent="submitServiceOrderForm">
    @csrf
    <div class="space-y-4">
        <!-- Técnico -->
        <div>
            <x-input-label for="technicial_id" :value="__('Técnico Responsável')" />
            <x-select-input id="technicial_id" name="technicial_id" required>
                <option value="">Selecione o técnico</option>
                @foreach ($technicials as $technicial)
                    <option value="{{ $technicial->id }}">
                        {{ $technicial->user->name ?? 'Sem nome' }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('technicial_id')" class="mt-2" />
        </div>

        <!-- Nome do Cliente -->
        <div>
            <x-input-label for="client_name" :value="__('Nome do Cliente')" />
            <x-text-input id="client_name" class="block mt-1 w-full" type="text" name="client_name" :value="old('client_name')"
                required autofocus autocomplete="client_name" />
            <x-input-error :messages="$errors->get('client_name')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div>
            <x-input-label for="client_address" :value="__('Endereço')" />
            <x-text-input id="client_address" class="block mt-1 w-full" type="text" name="client_address"
                :value="old('client_address')" required autocomplete="client_address" />
            <x-input-error :messages="$errors->get('client_address')" class="mt-2" />
        </div>

        <!-- Plano -->
        <div>
            <x-input-label for="client_plan" :value="__('Plano')" />
            <x-select-input id="client_plan" name="client_plan" required>
                <option value="">Selecione</option>
                <option value="400 M">400 M</option>
                <option value="500 M">500 M</option>
                <option value="750 M">750 M</option>
                <option value="1G">1G</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('client_plan')" class="mt-2" />
        </div>

        <!-- Tipo (velocidade) -->
        <div>
            <x-input-label for="type" :value="__('Tipo de Serviço')" />
            <x-select-input id="type" name="type" required>
                <option value="">Selecione</option>
                <option value="infra">Infra</option>
                <option value="instalacao">Instalação</option>
                <option value="mudanca_endereco">Mudança de Endereço</option>
                <option value="suporte">Suporte</option>
                <option value="outros">Outro</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div>
            <x-input-label for="description" :value="__('Descrição')" />
            <textarea id="description" name="description" rows="3"
                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Descreva o serviço...">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Status -->
        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input id="status" name="status" required>
                <option value="">Selecione</option>
                <option value="open">Aberto</option>
                <option value="in_progress">Em Progresso</option>
                <option value="closed">Concluído</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Botão -->
        <div class="flex justify-end mt-6">
            <x-primary-button class="ms-4">
                {{ __('Salvar') }}
            </x-primary-button>
        </div>
    </div>
</form>
