<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Equipment;
use App\Mail\LowStockAlertMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendLowStockAlert extends Command
{
    protected $signature = 'stock:check-low';

    protected $description = 'Envia e-mail diário de equipamentos com estoque baixo';

    public function handle()
    {
        Log::info('Rodando comando de verificação de estoque baixo');

        $lowStockEquipments = Equipment::whereColumn('quantity', '<', 'low_stock_threshold')
            ->get();

        if ($lowStockEquipments->isEmpty()) {
            Log::info('Nenhum equipamento com estoque baixo.');
            return Command::SUCCESS;
        }

        Log::info('Equipamentos com estoque baixo encontrados.', [
            'count' => $lowStockEquipments->count(),
        ]);

        $recipientEmail = [
            'ander23br03@gmail.com',
            // 'daniel@aip.com.br',
            // 'tania@aip.com.br',
        ];

        Mail::to($recipientEmail)
            ->send(new LowStockAlertMail($lowStockEquipments));

        Log::info('E-mail de estoque baixo enviado com sucesso.');

        return Command::SUCCESS;
    }
}
