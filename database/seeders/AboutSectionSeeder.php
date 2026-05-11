<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    public function run(): void
    {
        AboutSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => 'Who We Are',
                'title' => "About\nInteria Technologies",
                'intro_paragraph_1' => 'Interia Technologies was founded with one purpose: to make world-class IT accessible to every business in Las Vegas, regardless of size. We saw a gap — small businesses were either overpaying for enterprise firms that didn\'t understand their scale, or underserved by IT vendors who lacked the depth to handle real challenges.',
                'intro_paragraph_2' => 'We built a team of true industry leaders — professionals who\'ve worked inside the largest enterprise environments in the country — and redirected that expertise toward businesses that need it most: the ambitious, growing companies right here in the Las Vegas Valley.',
                'mission_title' => 'Our Mission',
                'mission_body' => 'To empower Las Vegas businesses with enterprise-grade technology solutions, delivered with the personal attention and transparency that only a local partner can provide.',
                'vision_title' => 'Our Vision',
                'vision_body' => 'A Las Vegas where every growing business operates with the same technological edge as the world\'s largest corporations — where technology becomes a strategic advantage, not a daily burden.',
                'footer_icon_path' => 'images/icon-place.svg',
                'footer_emphasis' => 'Born and based in Las Vegas, NV.',
                'footer_body' => "Our team lives here, works here, and is invested in the success of this community. When you partner with Interia, you're not calling a remote help desk — you're calling your neighbors.",
                'hero_image_path' => 'images/about-interia.png',
                'hero_image_alt' => 'Connected city skyline representing Interia Technologies',
                'is_active' => true,
            ],
        );
    }
}
