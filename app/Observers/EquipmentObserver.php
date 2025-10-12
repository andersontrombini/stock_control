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
        
         // Verifique se a quantidade foi alterada e se está abaixo do limite de estoque baixo
        if ($equipment->wasChanged('quantity') && $equipment->quantity < $equipment->low_stock_threshold) {
            
            Log::info('ALERTA DE ESTOQUE BAIXO ACIONADO', [
            'equipment_id' => $equipment->id,
            'quantity' => $equipment->quantity,
            'threshold' => $equipment->low_stock_threshold,
        ]);
            // Lógica para determinar para quem enviar o e-mail (ex: um administrador)
            $recipientEmail = 'ander23br03@gmail.com'; 
            
            // Envie o e-mail com o Mailable
            Mail::to($recipientEmail)->send(new LowStockAlertMail($equipment));
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
