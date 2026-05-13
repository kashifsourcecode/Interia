<?php

namespace Database\Seeders;

use App\Models\IndustryCard;
use App\Models\IndustrySection;
use Illuminate\Database\Seeder;

class IndustrySectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = IndustrySection::query()->updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => null,
                'title' => 'Industries',
                'description' => 'Technology, security, and cloud solutions tailored to how your sector operates — so your teams stay focused on what matters most.',
                'sub_heading' => 'Empowering Diverse Industries',
                'sub_lead' => 'Delivering tailored technology solutions that drive innovation, efficiency, and growth across diverse sectors.',
                'is_active' => true,
            ],
        );

        $section->cards()->delete();

        $cards = [
            [
                'sort_order' => 0,
                'mosaic_column' => 'left',
                'media_position' => 'image_first',
                'aspect_preset' => 'default',
                'title' => 'Small and Midsize Business',
                'description' => 'Helping growing businesses streamline operations, improve productivity, and accelerate digital transformation.',
                'image_path' => 'images/industries/small-business.png',
                'image_alt' => 'Project dashboard on a laptop for a growing business',
            ],
            [
                'sort_order' => 1,
                'mosaic_column' => 'left',
                'media_position' => 'text_first',
                'aspect_preset' => 'default',
                'title' => 'Cloud & Automation',
                'description' => 'Optimizing business workflows through intelligent cloud infrastructure and automated operational solutions.',
                'image_path' => 'images/industries/cloud-automation.png',
                'image_alt' => 'Cloud infrastructure and automation concept',
            ],
            [
                'sort_order' => 0,
                'mosaic_column' => 'center',
                'media_position' => 'text_first',
                'aspect_preset' => 'gaming',
                'title' => 'Gaming',
                'description' => 'Delivering scalable and immersive technology solutions designed for modern gaming platforms and interactive experiences.',
                'image_path' => 'images/industries/gaming.png',
                'image_alt' => 'Immersive gaming platform and interactive entertainment experience',
            ],
            [
                'sort_order' => 1,
                'mosaic_column' => 'center',
                'media_position' => 'image_first',
                'aspect_preset' => 'default',
                'title' => 'Security and Surveillance',
                'description' => 'Providing advanced monitoring, surveillance, and security solutions for safer and smarter environments.',
                'image_path' => 'images/industries/security.png',
                'image_alt' => 'Smart home security and monitoring on a smartphone',
            ],
            [
                'sort_order' => 0,
                'mosaic_column' => 'right',
                'media_position' => 'text_first',
                'aspect_preset' => 'default',
                'title' => 'Hospitality',
                'description' => 'Empowering hospitality businesses with seamless digital experiences, smart operations, and enhanced guest engagement solutions.',
                'image_path' => 'images/industries/hospitality.png',
                'image_alt' => 'Tablet showing travel and resort digital experience',
            ],
            [
                'sort_order' => 1,
                'mosaic_column' => 'right',
                'media_position' => 'text_first',
                'aspect_preset' => 'default',
                'title' => 'Health Care',
                'description' => 'Enabling healthcare providers with secure, efficient, and patient-focused digital systems for better care delivery.',
                'image_path' => 'images/industries/health-care.png',
                'image_alt' => 'Healthcare tablet and digital patient care tools',
            ],
        ];

        foreach ($cards as $row) {
            IndustryCard::query()->create(array_merge($row, [
                'industry_section_id' => $section->id,
            ]));
        }
    }
}
