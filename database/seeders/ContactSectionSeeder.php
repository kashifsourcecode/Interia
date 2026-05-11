<?php

namespace Database\Seeders;

use App\Models\ContactInfoCard;
use App\Models\ContactSection;
use Illuminate\Database\Seeder;

class ContactSectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = ContactSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => 'Get In Touch',
                'title' => "Let's Talk\nAbout Your IT",
                'subtitle' => 'Ready to take IT off your plate? Fill out the form and one of our Las Vegas-based experts will reach out within one business day.',
                'is_active' => true,
            ],
        );

        $section->infoCards()->delete();

        $cards = [
            [
                'heading' => 'Location',
                'body' => 'Las Vegas, Nevada',
                'icon_path' => 'images/icon-location.svg',
            ],
            [
                'heading' => 'Phone',
                'body' => '(702) 279 - 6711',
                'icon_path' => 'images/icon-phone.svg',
            ],
            [
                'heading' => 'Email',
                'body' => 'info@interiatechnologies.com',
                'icon_path' => 'images/icon-email.svg',
            ],
            [
                'heading' => 'Response Time',
                'body' => 'Within 15 minutes during business hours',
                'icon_path' => 'images/icon-time.svg',
            ],
            [
                'heading' => 'Onsite Support',
                'body' => 'Available across the greater Las Vegas Valley — included at no extra cost',
                'icon_path' => 'images/icon-handshake.svg',
            ],
        ];

        foreach ($cards as $order => $row) {
            ContactInfoCard::query()->create([
                'contact_section_id' => $section->id,
                'sort_order' => $order,
                'heading' => $row['heading'],
                'body' => $row['body'],
                'icon_path' => $row['icon_path'],
            ]);
        }
    }
}
