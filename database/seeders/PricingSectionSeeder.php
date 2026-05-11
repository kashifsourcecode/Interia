<?php

namespace Database\Seeders;

use App\Models\PricingAddonCard;
use App\Models\PricingPlan;
use App\Models\PricingSection;
use Illuminate\Database\Seeder;

class PricingSectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = PricingSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Simple, Transparent Pricing',
                'subtitle' => 'Scale your IT infrastructure with confidence. We provide enterprise-grade managed services with no hidden fees, tailored for growth-oriented organizations.',
                'addons_title' => 'Infrastructure Add-Ons',
                'addons_subtitle' => 'Specific pricing for servers, cloud environments, and physical locations.',
                'is_active' => true,
            ],
        );

        $section->plans()->delete();
        $section->addonCards()->delete();

        $plans = [
            [
                'name' => 'Core',
                'tagline' => 'Basics for small teams',
                'currency_symbol' => '$',
                'amount' => '499',
                'period' => '/month',
                'features' => [
                    ['line' => '24/7 Monitoring'],
                    ['line' => 'Standard Backup (Daily)'],
                    ['line' => 'Up to 10 Endpoints'],
                    ['line' => 'Next-Day On-Site Support'],
                ],
                'cta_label' => 'Select Core',
                'cta_url' => '#contact',
                'is_featured' => false,
            ],
            [
                'name' => 'Secure',
                'tagline' => 'Enhanced protection & support',
                'currency_symbol' => '$',
                'amount' => '1,299',
                'period' => '/month',
                'features' => [
                    ['line' => 'Everything in Core'],
                    ['line' => 'Advanced Threat Protection'],
                    ['line' => 'Cloud Backup (Real-time)'],
                    ['line' => '4-Hour Response SLA'],
                    ['line' => 'Dedicated Account Manager'],
                ],
                'cta_label' => 'Start with Secure',
                'cta_url' => '#contact',
                'is_featured' => true,
            ],
            [
                'name' => 'Premium',
                'tagline' => 'Full-scale enterprise IT',
                'currency_symbol' => '$',
                'amount' => '3,499',
                'period' => '/month',
                'features' => [
                    ['line' => 'Everything in Secure'],
                    ['line' => 'Unlimited Endpoints'],
                    ['line' => 'Full Disaster Recovery Plan'],
                    ['line' => 'Compliance Management'],
                ],
                'cta_label' => 'Talk to Enterprise',
                'cta_url' => '#contact',
                'is_featured' => false,
            ],
        ];

        foreach ($plans as $order => $row) {
            PricingPlan::query()->create([
                'pricing_section_id' => $section->id,
                'sort_order' => $order,
                'name' => $row['name'],
                'tagline' => $row['tagline'],
                'currency_symbol' => $row['currency_symbol'],
                'amount' => $row['amount'],
                'period' => $row['period'],
                'features' => $row['features'],
                'cta_label' => $row['cta_label'],
                'cta_url' => $row['cta_url'],
                'is_featured' => $row['is_featured'],
            ]);
        }

        $addons = [
            [
                'title' => 'Server Pricing',
                'icon_path' => 'images/icon-server-pricing.svg',
                'footer_description' => 'Includes patching, backup, and 24/7 uptime monitoring.',
                'rows' => [
                    ['label' => 'Standard Server', 'amount' => '$150', 'unit' => '/mo'],
                    ['label' => 'Critical Server', 'amount' => '$350', 'unit' => '/mo'],
                ],
            ],
            [
                'title' => 'Cloud Pricing',
                'icon_path' => 'images/icon-cloud-pricing.svg',
                'footer_description' => 'Comprehensive management for Azure, AWS, and GCP instances.',
                'rows' => [
                    ['label' => 'Per Tenant', 'amount' => '$250', 'unit' => '/mo'],
                    ['label' => 'Cloud Management', 'amount' => '5–10%', 'unit' => '/spend'],
                ],
            ],
            [
                'title' => 'Network/Site',
                'icon_path' => 'images/icon-site.svg',
                'footer_description' => 'Full site management including firewalls, switches, and APs.',
                'rows' => [
                    ['label' => 'Per Location', 'amount' => '$299', 'unit' => '/mo'],
                ],
            ],
        ];

        foreach ($addons as $order => $row) {
            PricingAddonCard::query()->create([
                'pricing_section_id' => $section->id,
                'sort_order' => $order,
                'title' => $row['title'],
                'icon_path' => $row['icon_path'],
                'footer_description' => $row['footer_description'],
                'rows' => $row['rows'],
            ]);
        }
    }
}
