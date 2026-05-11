<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\GallerySection;
use Illuminate\Database\Seeder;

class GallerySectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = GallerySection::updateOrCreate(
            ['slug' => 'home'],
            [
                'headline_line_1' => 'Trusted by creatives and leaders',
                'headline_line_2' => 'from various industries',
                'is_active' => true,
            ],
        );

        $section->items()->delete();

        $rows = [
            ['shape_key' => 'left-top', 'url' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=320&q=80', 'alt' => 'Quiet office workspace', 'tone_muted' => false],
            ['shape_key' => 'left-bottom', 'url' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=320&q=80', 'alt' => 'Team presentation room', 'tone_muted' => true],
            ['shape_key' => 'team', 'url' => 'https://images.unsplash.com/photo-1556761175-4b413da4baf72?w=420&q=80', 'alt' => 'People collaborating in a meeting', 'tone_muted' => false],
            ['shape_key' => 'desk', 'url' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=420&q=80', 'alt' => 'Shared work desk with laptops', 'tone_muted' => false],
            ['shape_key' => 'office', 'url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=420&q=80', 'alt' => 'Modern office interior', 'tone_muted' => false],
            ['shape_key' => 'coffee', 'url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=420&q=80', 'alt' => 'Coffee and notebook on desk', 'tone_muted' => false],
            ['shape_key' => 'window', 'url' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=420&q=80', 'alt' => 'Laptop beside a bright window', 'tone_muted' => false],
            ['shape_key' => 'people', 'url' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=420&q=80', 'alt' => 'Coworkers discussing a project', 'tone_muted' => false],
            ['shape_key' => 'meeting', 'url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=420&q=80', 'alt' => 'Business meeting at office table', 'tone_muted' => false],
            ['shape_key' => 'notes', 'url' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=320&q=80', 'alt' => 'Hand writing notes', 'tone_muted' => false],
            ['shape_key' => 'books', 'url' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=320&q=80', 'alt' => 'Business books stacked on a table', 'tone_muted' => false],
            ['shape_key' => 'laptop', 'url' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=320&q=80', 'alt' => 'Minimal laptop workspace', 'tone_muted' => true],
            ['shape_key' => 'student', 'url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=320&q=80', 'alt' => 'Person working with laptop', 'tone_muted' => false],
            ['shape_key' => 'culture', 'url' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=320&q=80', 'alt' => 'Two teammates in conversation', 'tone_muted' => false],
        ];

        foreach ($rows as $row) {
            GalleryItem::query()->create([
                'gallery_section_id' => $section->id,
                'shape_key' => $row['shape_key'],
                'image_path' => $row['url'],
                'image_alt' => $row['alt'],
                'tone_muted' => $row['tone_muted'],
            ]);
        }
    }
}
