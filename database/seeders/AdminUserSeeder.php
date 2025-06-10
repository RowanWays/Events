<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@events.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Rowan Aalders',
            'email' => 'rowanaalders06@gmail.com',
            'password' => bcrypt('RoAal124'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Test Gebruiker',
            'email' => 'user@events.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);
    }
}
