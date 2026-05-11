<?php

namespace Database\Seeders;

use App\Models\WhyFeature;
use App\Models\WhySection;
use Illuminate\Database\Seeder;

class WhySectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = WhySection::updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => 'Why Interia',
                'title' => "The Best of\nBoth Worlds",
                'description' => 'Most IT providers are either expensive enterprise firms or limited small vendors. We bridge the gap — delivering big-firm expertise with local, personal service.',
                'hero_image_path' => 'images/best-of-both-worlds.png',
                'hero_image_alt' => 'Las Vegas skyline with technology icons',
                'is_active' => true,
            ],
        );

        $section->features()->delete();

        $features = [
            [
                'title' => 'Enterprise-Level Expertise',
                'description' => 'Real industry leaders with Fortune 500 experience, serving your local business.',
                'icon_path' => 'images/icon-prize.svg',
            ],
            [
                'title' => 'Local Las Vegas Presence',
                'description' => 'Hands-on onsite support from a team that knows your city, your market, your needs.',
                'icon_path' => 'images/icon-location.svg',
            ],
            [
                'title' => 'No Hidden Fees',
                'description' => 'Transparent, predictable pricing. No surprise charges. Ever.',
                'icon_path' => 'images/icon-fees.svg',
            ],
            [
                'title' => 'Built for Tech-Reliant Businesses',
                'description' => 'Designed for companies where downtime is not an option and performance is everything.',
                'icon_path' => 'images/icon-power.svg',
            ],
        ];

        foreach ($features as $order => $row) {
            WhyFeature::query()->create([
                'why_section_id' => $section->id,
                'sort_order' => $order,
                'title' => $row['title'],
                'description' => $row['description'],
                'icon_path' => $row['icon_path'],
            ]);
        }
    }
}
