<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-500 via-slate-900 to-blue-900 text-white flex items-center justify-center">

    <div class="max-w-6xl w-full px-6 py-16 grid md:grid-cols-2 gap-12 items-center">

        <!-- Texto principal -->
        <div class="space-y-6">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Controle de Estoque
                <span class="text-orange-400">inteligente</span>
            </h1>

            <p class="text-slate-300 text-lg md:text-xl">
                Comunicação direta entre técnicos e estoque.
                Atualizações em tempo real, simples e organizadas.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <a href="{{ route('login') }}"
                   class="px-8 py-4 rounded-2xl bg-orange-500 hover:bg-orange-600 transition font-semibold text-center shadow-lg">
                    Entrar
                </a>

                <a href="{{ route('register') }}"
                   class="px-8 py-4 rounded-2xl border border-white/20 hover:bg-white/10 transition font-semibold text-center">
                    Criar conta
                </a>
            </div>
        </div>

        <!-- Card visual -->
        <div class="relative">
            <div class="absolute inset-0 bg-orange-500/20 blur-3xl rounded-full"></div>

            <div class="relative bg-slate-800/80 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">
                <h2 class="text-2xl font-semibold mb-6">O que você controla</h2>

                <ul class="space-y-4 text-slate-300">
                    <li class="flex items-center gap-3">📦 Estoque atualizado</li>
                    <li class="flex items-center gap-3">🛠 Solicitações de técnicos</li>
                    <li class="flex items-center gap-3">📊 Histórico de movimentações</li>
                    <li class="flex items-center gap-3">⚡ Comunicação rápida</li>
                </ul>
            </div>
        </div>

    </div>

</body>
</html>
