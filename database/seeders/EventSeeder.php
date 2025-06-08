<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::where('is_admin', true)->first();

        \App\Models\Event::create([
            'title' => 'Laravel Workshop',
            'description' => 'Een intensieve workshop over Laravel development. Leer de basis van het framework en bouw je eerste applicatie.',
            'location' => 'Amsterdam, Nederland',
            'start_date' => now()->addDays(7)->setTime(10, 0),
            'end_date' => now()->addDays(7)->setTime(17, 0),
            'price' => 149.99,
            'max_tickets' => 50,
            'available_tickets' => 50,
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        \App\Models\Event::create([
            'title' => 'Muziekfestival Summer Vibes',
            'description' => 'Het grootste muziekfestival van de zomer! Met optredens van bekende artiesten en nieuwe talenten.',
            'location' => 'Park Frankendael, Amsterdam',
            'start_date' => now()->addDays(30)->setTime(14, 0),
            'end_date' => now()->addDays(30)->setTime(23, 0),
            'price' => 89.50,
            'max_tickets' => 1000,
            'available_tickets' => 1000,
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        \App\Models\Event::create([
            'title' => 'Tech Conference 2025',
            'description' => 'Ontdek de nieuwste trends in technologie. Keynotes, workshops en networking mogelijkheden.',
            'location' => 'RAI Amsterdam',
            'start_date' => now()->addDays(45)->setTime(9, 0),
            'end_date' => now()->addDays(45)->setTime(18, 0),
            'price' => 299.00,
            'max_tickets' => 200,
            'available_tickets' => 200,
            'is_active' => true,
            'created_by' => $admin->id,
        ]);
    }
}
