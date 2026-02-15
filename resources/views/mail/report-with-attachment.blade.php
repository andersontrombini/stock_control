<x-guest-layout>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-gray-900 dark:text-gray-100 font-sans">

        <h1 class="text-2xl font-bold mb-4 text-blue-600 dark:text-blue-400">
            {{ $title }}
        </h1>

        <p class="mb-4">
            {{ $messageText }}
        </p>

        <p class="mb-4">
            📎 A planilha está anexada a este e-mail.
        </p>

        <hr class="border-gray-200 dark:border-gray-700 my-4">

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Este é um e-mail automático. Não responda.
        </p>

    </div>
</x-guest-layout>
