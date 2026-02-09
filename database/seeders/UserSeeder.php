<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        $admin = User::create([
            'name' => 'Daniel',
            'email' => 'daniel@aip.com.br',
            'password' => Hash::make('W5tnn5tu'),
            'is_admin' => true,
            'email_verified_at' => Carbon::now(),
        ]);

        $technical = User::create([
            'name' => 'Técnico',
            'email' => 'trombini.dev@gmail.com',
            'password' => Hash::make('W5tnn5tu'),
            'is_admin' => false,
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
