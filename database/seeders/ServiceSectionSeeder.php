<?php

namespace Database\Seeders;

use App\Models\ServiceCard;
use App\Models\ServiceCarouselItem;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class ServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = ServiceSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => 'Our Services',
                'title' => "Managed IT Built\nfor Small Business",
                'description' => 'We deliver the same level of IT expertise used by large enterprises—tailored for small and mid-sized businesses in Las Vegas.',
                'is_active' => true,
            ],
        );

        $section->carouselItems()->delete();
        $section->cards()->delete();

        $carousel = [
            ['caption' => 'Server Installation', 'alt' => 'IT technician at server rack', 'url' => 'https://images.unsplash.com/photo-1614624532983-4ce03382d63d?w=640&q=80'],
            ['caption' => 'Team Support', 'alt' => 'IT team meeting', 'url' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=640&q=80'],
            ['caption' => 'On-Call Support', 'alt' => 'IT support specialist', 'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=640&q=80'],
            ['caption' => 'Network Setup', 'alt' => 'Network infrastructure', 'url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=640&q=80'],
            ['caption' => 'Security Operations', 'alt' => 'Cybersecurity monitoring', 'url' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=640&q=80'],
            ['caption' => 'IT Consultation', 'alt' => 'Business IT consultation', 'url' => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=640&q=80'],
            ['caption' => 'Cloud Migration', 'alt' => 'Cloud computing setup', 'url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=640&q=80'],
            ['caption' => 'Data Center', 'alt' => 'Data center management', 'url' => 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=640&q=80'],
        ];

        foreach ($carousel as $order => $row) {
            ServiceCarouselItem::query()->create([
                'service_section_id' => $section->id,
                'sort_order' => $order,
                'image_path' => $row['url'],
                'caption' => $row['caption'],
                'image_alt' => $row['alt'],
            ]);
        }

        $cards = [
            [
                'name' => 'Managed IT Services',
                'description' => 'Proactive monitoring, support, and maintenance to keep your systems running smoothly — 24/7, without the headaches.',
                'icon_path' => 'images/icon-laptop.svg',
                'cta_label' => 'Learn more',
                'cta_url' => '#contact',
            ],
            [
                'name' => 'Cloud & Server Management',
                'description' => 'We manage your cloud environments, servers, and infrastructure so you can focus on running your business, not your tech stack.',
                'icon_path' => 'images/icon-cloud.svg',
                'cta_label' => 'Learn more',
                'cta_url' => '#contact',
            ],
            [
                'name' => 'Cybersecurity',
                'description' => 'Advanced protection against modern threats, using enterprise-grade tools and practices typically reserved for large corporations.',
                'icon_path' => 'images/icon-security.svg',
                'cta_label' => 'Learn more',
                'cta_url' => '#contact',
            ],
            [
                'name' => 'Onsite + Remote Support',
                'description' => 'Unlike others, we include onsite support at no additional cost. Real hands-on help, right when and where you need it.',
                'icon_path' => 'images/icon-handshake.svg',
                'cta_label' => 'Learn more',
                'cta_url' => '#contact',
            ],
        ];

        foreach ($cards as $order => $row) {
            ServiceCard::query()->create([
                'service_section_id' => $section->id,
                'sort_order' => $order,
                'name' => $row['name'],
                'description' => $row['description'],
                'icon_path' => $row['icon_path'],
                'cta_label' => $row['cta_label'],
                'cta_url' => $row['cta_url'],
            ]);
        }
    }
}
