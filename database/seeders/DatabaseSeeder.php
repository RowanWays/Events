<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create some events
        $events = [
            [
                'title' => 'Summer Music Festival',
                'description' => 'Join us for a day of amazing music performances by local and international artists. Food and drinks will be available.',
                'location' => 'City Park',
                'start_time' => now()->addDays(15)->setHour(12),
                'end_time' => now()->addDays(15)->setHour(23),
                'created_by' => $adminUser->id,
            ],
            [
                'title' => 'Tech Conference 2023',
                'description' => 'A conference focused on the latest technologies and innovations. Perfect for developers, designers, and tech enthusiasts.',
                'location' => 'Convention Center',
                'start_time' => now()->addDays(30)->setHour(9),
                'end_time' => now()->addDays(31)->setHour(18),
                'created_by' => $adminUser->id,
            ],
            [
                'title' => 'Charity Run',
                'description' => 'A 5K run to raise funds for local charities. All ages and fitness levels are welcome to participate.',
                'location' => 'Downtown',
                'start_time' => now()->addDays(45)->setHour(8),
                'end_time' => now()->addDays(45)->setHour(12),
                'created_by' => $regularUser->id,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
