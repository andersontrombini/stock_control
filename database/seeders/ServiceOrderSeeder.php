<?php

namespace Database\Seeders;

use App\Models\ServiceOrder;
use App\Models\Technical;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceOrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        $plans = ['400M', '750M', '1G'];
        $types = ['instalacao', 'mudanca_endereco', 'suporte'];
        $statuses = ['open', 'in_progress', 'closed'];

        // 🔑 busca o técnico existente (NÃO usa id fixo)
        $technical = Technical::first();

        if (!$technical) {
            $this->command->error('Nenhum técnico encontrado.');
            return;
        }

        for ($i = 0; $i < 15; $i++) {
            ServiceOrder::create([
                'technicial_id' => $technical->id,
                'client_name' => $faker->name,
                'client_address' => $faker->streetAddress,
                'client_plan' => $faker->randomElement($plans),
                'type' => $faker->randomElement($types),
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}
