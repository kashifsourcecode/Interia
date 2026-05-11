<?php

namespace Database\Seeders;

use App\Models\OfferCard;
use App\Models\OfferSection;
use Illuminate\Database\Seeder;

class OfferSectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = OfferSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => 'Complimentary',
                'title' => "Start for Free.\nSee the Value.",
                'description' => 'No commitment needed. Experience what Interia Technologies can do for your business before signing anything.',
                'is_active' => true,
            ],
        );

        $section->cards()->delete();

        $cards = [
            [
                'pill_label' => 'Complimentary',
                'title' => 'Free IT Assessment',
                'description' => "Let our experts take a comprehensive look at your current IT infrastructure. We'll identify vulnerabilities, inefficiencies, and opportunities — then give you a clear, honest report. No strings attached.",
                'icon_path' => 'images/icon-free-assessment.svg',
                'cta_label' => 'Book Your Assessment →',
                'cta_url' => '#contact',
                'theme' => 'gold',
            ],
            [
                'pill_label' => 'Workshop',
                'title' => 'Free AI Workshops',
                'description' => 'Learn how AI can automate tasks, improve efficiency, and give your business a competitive edge. Our hands-on workshops are designed for business owners and teams — no technical background required.',
                'icon_path' => 'images/icon-ai-workshop.svg',
                'cta_label' => 'Reserve Your Spot →',
                'cta_url' => '#contact',
                'theme' => 'blue',
            ],
        ];

        foreach ($cards as $order => $row) {
            OfferCard::query()->create([
                'offer_section_id' => $section->id,
                'sort_order' => $order,
                'pill_label' => $row['pill_label'],
                'title' => $row['title'],
                'description' => $row['description'],
                'icon_path' => $row['icon_path'],
                'cta_label' => $row['cta_label'],
                'cta_url' => $row['cta_url'],
                'theme' => $row['theme'],
            ]);
        }
    }
}
