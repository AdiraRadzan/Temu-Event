<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\EventCategory;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $categories = EventCategory::all();
        $organizers = User::eventOrganizer()->approved()->get();

        if ($categories->isEmpty() || $organizers->isEmpty()) {
            $this->call([EventCategorySeeder::class, UserSeeder::class]);
            $categories = EventCategory::all();
            $organizers = User::eventOrganizer()->approved()->get();
        }

        $events = [
            [
                'title' => 'Jakarta Tech Summit 2025',
                'description' => 'Konferensi teknologi terbesar di Indonesia dengan berbagai sesi tentang AI, Blockchain, dan Future of Tech. Join thousands of tech enthusiasts, developers, and industry leaders for a day of learning and networking.',
                'short_description' => 'Konferensi teknologi terbesar di Indonesia',
                'category_id' => $categories->where('slug', 'teknologi')->first()->id,
                'organizer_id' => $organizers->first()->id,
                'start_date' => Carbon::now()->addDays(30)->setTime(9, 0),
                'end_date' => Carbon::now()->addDays(30)->setTime(17, 0),
                'location' => 'Jakarta Convention Center',
                'venue' => 'Main Hall A',
                'address' => 'Jl. Gatot Subroto, Senayan, Jakarta Pusat',
                'max_participants' => 2000,
                'price' => 150000,
                'event_type' => 'paid',
                'status' => 'published',
                'is_featured' => true,
                'requirements' => ['Laptop', 'Notebook', 'Charging cable'],
                'tags' => ['technology', 'AI', 'blockchain', 'networking'],
                'contact_info' => 'Email: info@techevents.com | Phone: +62-21-1234-5678',
            ],
            [
                'title' => 'Creative Workshop: Digital Art & Design',
                'description' => 'Workshop intensif tentang digital art dan design menggunakan tools modern. Ideal untuk designer, illustrator, dan creative professionals yang ingin meningkatkan skills mereka.',
                'short_description' => 'Workshop digital art dan design',
                'category_id' => $categories->where('slug', 'kesenian-budaya')->first()->id,
                'organizer_id' => $organizers->skip(1)->first()->id,
                'start_date' => Carbon::now()->addDays(10)->setTime(10, 0),
                'end_date' => Carbon::now()->addDays(10)->setTime(16, 0),
                'location' => 'Creative Hub Jakarta',
                'venue' => 'Studio 1',
                'address' => 'Jl. Kemang Raya, Jakarta Selatan',
                'max_participants' => 50,
                'price' => 75000,
                'event_type' => 'paid',
                'status' => 'published',
                'is_featured' => false,
                'requirements' => ['Laptop dengan Adobe Creative Suite', 'Tablet drawing (optional)'],
                'tags' => ['design', 'digital art', 'workshop', 'creative'],
                'contact_info' => 'Email: workshop@creative.com | Phone: +62-21-9876-5432',
            ],
            [
                'title' => 'Startup Pitch Night Jakarta',
                'description' => 'Networking event dan startup pitching competition. Dapatkan kesempatan untuk mempresentasikan ide startup Anda di depan investor dan mentor terkenal.',
                'short_description' => 'Startup pitching dan networking',
                'category_id' => $categories->where('slug', 'bisnis-kewirausahaan')->first()->id,
                'organizer_id' => $organizers->first()->id,
                'start_date' => Carbon::now()->addDays(20)->setTime(18, 0),
                'end_date' => Carbon::now()->addDays(20)->setTime(21, 0),
                'location' => 'WeWork Indonesia',
                'venue' => 'Event Space',
                'address' => 'Pacific Place, SCBD, Jakarta Selatan',
                'max_participants' => 200,
                'price' => 0,
                'event_type' => 'free',
                'status' => 'published',
                'is_featured' => true,
                'requirements' => ['Pitch deck (untuk presenter)', 'Business card'],
                'tags' => ['startup', 'pitching', 'networking', 'investment'],
                'contact_info' => 'Email: pitch@startup.com | Phone: +62-21-5555-7777',
            ],
            [
                'title' => 'Jakarta Food Festival 2025',
                'description' => 'Festival makanan terbesar di Jakarta dengan berbagai stall makanan dari berbagai daerah. Nikmati kuliner autentik Indonesia dan internasional.',
                'short_description' => 'Festival makanan terbesar di Jakarta',
                'category_id' => $categories->where('slug', 'kuliner')->first()->id,
                'organizer_id' => $organizers->skip(1)->first()->id,
                'start_date' => Carbon::now()->addDays(45)->setTime(10, 0),
                'end_date' => Carbon::now()->addDays(47)->setTime(22, 0),
                'location' => 'Museum Taman Prasetya',
                'venue' => 'Outdoor Area',
                'address' => 'Jl. Cikini Raya, Jakarta Pusat',
                'max_participants' => 5000,
                'price' => 25000,
                'event_type' => 'paid',
                'status' => 'published',
                'is_featured' => false,
                'requirements' => ['Toleransi terhadap makanan pedas'],
                'tags' => ['food', 'festival', 'kuliner', 'indonesia'],
                'contact_info' => 'Email: food@festival.com | Phone: +62-21-9876-5432',
            ],
            [
                'title' => 'Professional Networking Meetup',
                'description' => 'Networking event untuk professional dari berbagai industri. Perfect untuk expand your network dan exchange insights.',
                'short_description' => 'Networking event untuk professional',
                'category_id' => $categories->where('slug', 'networking')->first()->id,
                'organizer_id' => $organizers->first()->id,
                'start_date' => Carbon::now()->addDays(10)->setTime(19, 0),
                'end_date' => Carbon::now()->addDays(10)->setTime(22, 0),
                'location' => 'The Langham Hotel',
                'venue' => 'Ballroom',
                'address' => 'Jl. Colombo No.1, Jakarta Selatan',
                'max_participants' => 150,
                'price' => 100000,
                'event_type' => 'paid',
                'status' => 'published',
                'is_featured' => false,
                'requirements' => ['Business attire', 'Business card'],
                'tags' => ['networking', 'professional', 'business', 'career'],
                'contact_info' => 'Email: networking@meetup.com | Phone: +62-21-1234-5678',
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
