<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\HeroStatItem;
use App\Models\HeroTrustChip;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = HeroSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'badge_text' => 'Las Vegas — Local IT Experts',
                'headline_line_1' => 'Technology solutions',
                'headline_line_2_lead' => 'that ',
                'headline_line_2_accent' => 'power your business.',
                'subheadline' => 'Enterprise-grade IT services with a local team and no extra cost for onsite support.',
                'background_mode' => 'video',
                'background_video_path' => 'videos/it-video.mp4',
                'background_image_path' => null,
                'primary_cta_label' => 'Free IT Assessment',
                'primary_cta_url' => route('website.section.contact'),
                'primary_cta_icon_path' => null,
                'secondary_cta_label' => 'Free AI Workshops',
                'secondary_cta_url' => route('website.section.offers'),
                'secondary_cta_icon_path' => null,
                'secondary_cta_show_arrow' => true,
                'is_active' => true,
            ],
        );

        $section->trustChips()->delete();

        $chips = [
            'Fast Response Times',
            'Onsite Support Included',
            'Enterprise-Grade Security',
            'Local Las Vegas Team',
        ];

        foreach ($chips as $order => $label) {
            HeroTrustChip::query()->create([
                'hero_section_id' => $section->id,
                'sort_order' => $order,
                'label' => $label,
            ]);
        }

        $section->statItems()->delete();

        $stats = [
            [
                'sort_order' => 0,
                'label' => 'Businesses Served',
                'count_target' => 200,
                'count_as_decimal' => false,
                'suffix_after_count' => null,
                'static_display' => null,
            ],
            [
                'sort_order' => 1,
                'label' => 'Uptime SLA %',
                'count_target' => 99.9,
                'count_as_decimal' => true,
                'suffix_after_count' => null,
                'static_display' => null,
            ],
            [
                'sort_order' => 2,
                'label' => 'Avg Response Time',
                'count_target' => 15,
                'count_as_decimal' => false,
                'suffix_after_count' => 'min',
                'static_display' => null,
            ],
            [
                'sort_order' => 3,
                'label' => 'Years Experience',
                'count_target' => 10,
                'count_as_decimal' => false,
                'suffix_after_count' => '+',
                'static_display' => null,
            ],
        ];

        foreach ($stats as $row) {
            HeroStatItem::query()->create([
                'hero_section_id' => $section->id,
                'sort_order' => $row['sort_order'],
                'label' => $row['label'],
                'count_target' => $row['count_target'],
                'count_as_decimal' => $row['count_as_decimal'],
                'suffix_after_count' => $row['suffix_after_count'],
                'static_display' => $row['static_display'],
            ]);
        }
    }
}
