<?php

if (! function_exists('service_type_label')) {
    function service_type_label(string $type): string
    {
        return [
            'infra'             => 'Infraestrutura',
            'instalacao'        => 'Instalação',
            'mudanca_endereco'  => 'Mudança de endereço',
            'outros'            => 'Outros',
            'suporte'           => 'Suporte Técnico',
        ][$type] ?? ucfirst($type);
    }
}

if (! function_exists('service_status_badge')) {
    function service_status_badge(string $status): array
    {
        return [
            'open' => [
                'label' => 'Pendente',
                'class' => 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100',
            ],
            'in_progress' => [
                'label' => 'Em Progresso',
                'class' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100',
            ],
            'closed' => [
                'label' => 'Concluído',
                'class' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100',
            ],
        ][$status] ?? [
            'label' => ucfirst($status),
            'class' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100',
        ];
    }
}
