<?php

namespace Database\Seeders;

use App\Models\Technical;
use App\Models\User;
use Illuminate\Database\Seeder;

class TechnicalSeeder extends Seeder
{
    public function run(): void
    {
        Technical::query()->delete();

        $user = User::where('email', 'trombini.dev@gmail.com')->first();

        if (!$user) {
            return;
        }

        Technical::create([
            'user_id' => $user->id,
            'phone' => '(14) 9 9588-9988',
        ]);
    }
}
