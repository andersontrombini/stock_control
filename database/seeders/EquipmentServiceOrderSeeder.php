<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceOrder;
use App\Models\Equipment;

class EquipmentServiceOrderSeeder extends Seeder
{
    public function run(): void
    {
        $closedOrders = ServiceOrder::where('status', 'closed')->get();
        $equipments = Equipment::all();

        foreach ($closedOrders as $order) {

            // pula se já tiver vínculo (idempotente)
            if ($order->equipment()->exists()) {
                continue;
            }

            $items = $equipments->random(rand(3, 5));

            foreach ($items as $equipment) {
                $order->equipment()->attach($equipment->id, [
                    'quantity_used' => rand(1, 3),
                ]);
            }
        }
    }
}
