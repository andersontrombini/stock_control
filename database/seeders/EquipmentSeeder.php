<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $equipments = [
            ['name' => 'ONU azul', 'quantity' => 1, 'low_stock_threshold' => 10],
            ['name' => 'ONU verde', 'quantity' => 20, 'low_stock_threshold' => 5],
            ['name' => 'ONU verde grande', 'quantity' => 3, 'low_stock_threshold' => 10],
            ['name' => 'conectores', 'quantity' => 22, 'low_stock_threshold' => 15],
            ['name' => 'acopladores', 'quantity' => 42, 'low_stock_threshold' => 20],
            ['name' => 'roseta', 'quantity' => 40, 'low_stock_threshold' => 10],
            ['name' => 'cordão azul', 'quantity' => 7, 'low_stock_threshold' => 5],
            ['name' => 'cordão verde', 'quantity' => 21, 'low_stock_threshold' => 10],
            ['name' => 'router AX2S', 'quantity' => 12, 'low_stock_threshold' => 5],
            ['name' => 'router AX2', 'quantity' => 15, 'low_stock_threshold' => 5],
            ['name' => 'fita aço', 'quantity' => 2, 'low_stock_threshold' => 3],
            ['name' => 'isolante', 'quantity' => 3, 'low_stock_threshold' => 5],
            ['name' => 'alça', 'quantity' => 40, 'low_stock_threshold' => 10],
            ['name' => 'feixo', 'quantity' => 100, 'low_stock_threshold' => 20],
            ['name' => 'roldana', 'quantity' => 55, 'low_stock_threshold' => 15],
            ['name' => 'bobina', 'quantity' => 1800, 'low_stock_threshold' => 300],
            ['name' => 'Rj45', 'quantity' => 60, 'low_stock_threshold' => 10],
            ['name' => 'dupla face', 'quantity' => 1, 'low_stock_threshold' => 5],
            ['name' => 'bap 2', 'quantity' => 24, 'low_stock_threshold' => 5],
            ['name' => 'bap 3', 'quantity' => 15, 'low_stock_threshold' => 5],
        ];

        foreach ($equipments as $item) {
            Equipment::updateOrCreate(
                ['name' => $item['name']],
                [
                    'quantity' => $item['quantity'],
                    'status' => 'active',
                    'low_stock_threshold' => $item['low_stock_threshold'],
                ]
            );
        }
    }
}
