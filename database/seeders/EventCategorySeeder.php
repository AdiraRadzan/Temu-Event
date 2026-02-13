<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventCategory;

class EventCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'description' => 'Event-event terkait teknologi, software, dan pengembangan',
                'icon' => 'computer-desktop',
                'is_active' => true,
            ],
            [
                'name' => 'Bisnis & Kewirausahaan',
                'slug' => 'bisnis-kewirausahaan',
                'description' => 'Event bisnis, workshop kewirausahaan, dan networking',
                'icon' => 'briefcase',
                'is_active' => true,
            ],
            [
                'name' => 'Kesenian & Budaya',
                'slug' => 'kesenian-budaya',
                'description' => 'Festival seni, pertunjukan budaya, dan exhibition',
                'icon' => 'color-swatch',
                'is_active' => true,
            ],
            [
                'name' => 'Olahraga',
                'slug' => 'olahraga',
                'description' => 'Turnamen olahraga, fitness, dan kegiatan fisik',
                'icon' => 'heart',
                'is_active' => true,
            ],
            [
                'name' => 'Pendidikan',
                'slug' => 'pendidikan',
                'description' => 'Seminar, workshop, dan event edukatif',
                'icon' => 'academic-cap',
                'is_active' => true,
            ],
            [
                'name' => 'Hiburan',
                'slug' => 'hiburan',
                'description' => 'Konser, festival musik, dan event entertainment',
                'icon' => 'musical-note',
                'is_active' => true,
            ],
            [
                'name' => 'Kuliner',
                'slug' => 'kuliner',
                'description' => 'Food festival, cooking class, dan event gastronomis',
                'icon' => 'cake',
                'is_active' => true,
            ],
            [
                'name' => 'Networking',
                'slug' => 'networking',
                'description' => 'Event networking, meetup, dan professional gathering',
                'icon' => 'users',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            EventCategory::create($category);
        }
    }
}
