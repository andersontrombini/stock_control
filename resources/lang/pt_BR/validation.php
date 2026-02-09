<?php

return [

    'integer' => 'O campo :attribute deve ser um número inteiro.',

    'required' => 'O campo :attribute é obrigatório.',
    'string'   => 'O campo :attribute deve ser um texto.',
    'numeric'  => 'O campo :attribute deve ser um número.',
    'email'    => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'max' => [
        'string' => 'O campo :attribute não pode ter mais que :max caracteres.',
    ],
    'min' => [
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos amigáveis
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'quantity' => 'quantidade',
        'client_name' => 'cliente',
        'client_address' => 'endereço',
        'client_plan' => 'plano',
    ],
];
