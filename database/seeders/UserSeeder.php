<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@temuvent.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'approved',
            'email_verified_at' => now(),
            'bio' => 'Administrator TemuEvent',
        ]);

        // Create Event Organizers
        $organizers = [
            [
                'name' => 'TechEvent Indonesia',
                'email' => 'techevent@company.com',
                'password' => Hash::make('password123'),
                'role' => 'event_organizer',
                'status' => 'approved',
                'organization_name' => 'TechEvent Indonesia',
                'phone' => '+62-21-1234-5678',
                'bio' => 'Penyelenggara event teknologi terbesar di Indonesia',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Creative Arts Festival',
                'email' => 'creative@festival.com',
                'password' => Hash::make('password123'),
                'role' => 'event_organizer',
                'status' => 'approved',
                'organization_name' => 'Creative Arts Festival',
                'phone' => '+62-21-9876-5432',
                'bio' => 'Organizer festival seni dan budaya kreatif',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Startup Hub Jakarta',
                'email' => 'startup@hub.com',
                'password' => Hash::make('password123'),
                'role' => 'event_organizer',
                'status' => 'pending',
                'organization_name' => 'Startup Hub Jakarta',
                'phone' => '+62-21-5555-7777',
                'bio' => 'Komunitas startup dan kewirausahaan',
            ],
        ];

        foreach ($organizers as $organizer) {
            User::create($organizer);
        }

        // Create Regular Users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 'approved',
                'phone' => '+62-21-1111-2222',
                'bio' => 'Tech enthusiast dan event-goer',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 'approved',
                'phone' => '+62-21-3333-4444',
                'bio' => 'Creative professional yang suka ikut event seni',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'status' => 'approved',
                'phone' => '+62-21-5555-6666',
                'bio' => 'Startup founder dan business enthusiast',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
