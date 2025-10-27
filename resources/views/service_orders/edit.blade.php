<form action="{{ route('service_orders.update', $serviceOrder->id) }}" method="POST"
    onsubmit="submitServiceOrderForm(event)">
    @csrf
    @method('PUT')

    <div class="space-y-4">
        <!-- Técnico -->
        <div>
            <x-input-label for="technicial_id" :value="__('Técnico Responsável')" />
            <x-select-input id="technicial_id" name="technicial_id" required>
                <option value="">Selecione o técnico</option>
                @foreach ($technicials as $technicial)
                    <option value="{{ $technicial->id }}"
                        {{ $serviceOrder->technicial_id == $technicial->id ? 'selected' : '' }}>
                        {{ $technicial->user->name ?? 'Sem nome' }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('technicial_id')" class="mt-2" />
        </div>

        <!-- Nome do Cliente -->
        <div>
            <x-input-label for="client_name" :value="__('Nome do Cliente')" />
            <x-text-input id="client_name" class="block mt-1 w-full" type="text" name="client_name" :value="old('client_name', $serviceOrder->client_name)"
                required autocomplete="client_name" />
            <x-input-error :messages="$errors->get('client_name')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div>
            <x-input-label for="client_address" :value="__('Endereço')" />
            <x-text-input id="client_address" class="block mt-1 w-full" type="text" name="client_address"
                :value="old('client_address', $serviceOrder->client_address)" required autocomplete="client_address" />
            <x-input-error :messages="$errors->get('client_address')" class="mt-2" />
        </div>

        <!-- Plano -->
        <div>
            <x-input-label for="client_plan" :value="__('Plano')" />
            <x-select-input id="client_plan" name="client_plan" required>
                <option value="">Selecione</option>
                @foreach (['400 M', '500 M', '750 M', '1G'] as $plan)
                    <option value="{{ $plan }}" {{ $serviceOrder->client_plan === $plan ? 'selected' : '' }}>
                        {{ $plan }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('client_plan')" class="mt-2" />
        </div>

        <!-- Tipo -->
        <div>
            <x-input-label for="type" :value="__('Tipo de Serviço')" />
            <x-select-input id="type" name="type" required>
                <option value="">Selecione</option>
                @foreach ([
        'infra' => 'Infra',
        'instalacao' => 'Instalação',
        'mudanca_endereco' => 'Mudança de Endereço',
        'suporte' => 'Suporte',
        'outros' => 'Outro',
    ] as $value => $label)
                    <option value="{{ $value }}" {{ $serviceOrder->type === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div>
            <x-input-label for="description" :value="__('Descrição')" />
            <textarea id="description" name="description" rows="3"
                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 
                             dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Descreva o serviço...">{{ old('description', $serviceOrder->description) }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Status -->
        <div>
            <x-input-label for="status" :value="__('Status')" />
            <x-select-input id="status" name="status" required>
                <option value="">Selecione</option>
                @foreach ([
        'open' => 'Aberto',
        'in_progress' => 'Em Progresso',
        'closed' => 'Concluído',
    ] as $value => $label)
                    <option value="{{ $value }}" {{ $serviceOrder->status === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Botões -->
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
            Salvar Alterações
        </button>
</form>
