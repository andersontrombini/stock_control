<?php

namespace App\Observers;

use App\Mail\LowStockAlertMail;
use App\Models\Equipment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EquipmentObserver
{
    /**
     * Handle the Equipment "created" event.
     */
    public function created(Equipment $equipment): void
    {
        //
    }

    /**
     * Handle the Equipment "updated" event.
     */
    public function updated(Equipment $equipment): void
    {

        if ($equipment->wasChanged('quantity')) {

            // Busca todos os equipamentos com estoque baixo
            $lowStockEquipments = Equipment::whereColumn('quantity', '<', 'low_stock_threshold')->get();

            if ($lowStockEquipments->isNotEmpty()) {
                Log::info('Equipamentos com estoque baixo encontrados.', [
                    'count' => $lowStockEquipments->count(),
                ]);

                //  $recipientEmail = ['ander23br03@gmail.com', 'daniel@aip.com.br', 'tania@aip.com.br'];
                $recipientEmail = 'ander23br03@gmail.com';

                // Envia um e-mail único com todos os equipamentos
                Mail::to($recipientEmail)->send(new LowStockAlertMail($lowStockEquipments));
            } else {
                Log::info('Nenhum equipamento com estoque baixo encontrado.');
            }
        }
    }

    /**
     * Handle the Equipment "deleted" event.
     */
    public function deleted(Equipment $equipment): void
    {
        //
    }

    /**
     * Handle the Equipment "restored" event.
     */
    public function restored(Equipment $equipment): void
    {
        //
    }

    /**
     * Handle the Equipment "force deleted" event.
     */
    public function forceDeleted(Equipment $equipment): void
    {
        //
    }
}
