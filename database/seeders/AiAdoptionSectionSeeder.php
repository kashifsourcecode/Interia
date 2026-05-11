<?php

namespace Database\Seeders;

use App\Models\AiAdoptionChecklistItem;
use App\Models\AiAdoptionSection;
use App\Models\AiAdoptionStep;
use Illuminate\Database\Seeder;

class AiAdoptionSectionSeeder extends Seeder
{
    public function run(): void
    {
        $section = AiAdoptionSection::updateOrCreate(
            ['slug' => 'home'],
            [
                'label' => 'AI Adoption',
                'title' => 'How AI Enhances Every Layer of Your Business',
                'subtitle' => 'Seamlessly weave intelligence through your entire enterprise stack, from edge monitoring to executive decision-making.',
                'framework_heading' => 'The Executive IT Framework',
                'framework_description' => "Our AI doesn't just surface problems—it resolves them before they impact your bottom line. We provide a comprehensive visibility layer that spans from bare-metal servers to the user experience.",
                'dashboard_image_path' => 'images/ai-system-dashboard.png',
                'dashboard_image_alt' => 'AI system dashboard with charts, graphs, and analytics visualizations',
                'is_active' => true,
            ],
        );

        $section->steps()->delete();
        $section->checklistItems()->delete();

        $steps = [
            [
                'step_label' => 'Step 01',
                'title' => 'Detect',
                'description' => 'Cloud Monitoring focusing on real-time identification of network anomalies and performance dips.',
                'style_key' => 'detect',
                'icon_path' => 'images/icon-ai-detect.svg',
            ],
            [
                'step_label' => 'Step 02',
                'title' => 'Analyze',
                'description' => 'Cybersecurity layers utilizing deep behavioral analysis to isolate sophisticated zero-day threats.',
                'style_key' => 'analyze',
                'icon_path' => 'images/icon-ai-analyze.svg',
            ],
            [
                'step_label' => 'Step 03',
                'title' => 'Automate',
                'description' => 'Support Automation through intelligent ticketing and instant NLP-driven resolution engines.',
                'style_key' => 'automate',
                'icon_path' => 'images/icon-ai-automate.svg',
            ],
            [
                'step_label' => 'Step 04',
                'title' => 'Secure',
                'description' => 'Predictive Maintenance for preemptive hardening of systems before failures occur.',
                'style_key' => 'secure',
                'icon_path' => 'images/icon-ai-secure.svg',
            ],
            [
                'step_label' => 'Step 05',
                'title' => 'Optimize',
                'description' => 'Workflow Optimization focusing on enterprise-wide efficiency gains and resource allocation.',
                'style_key' => 'optimize',
                'icon_path' => 'images/icon-ai-optimize.svg',
                'stat_emphasis' => '+32%',
                'stat_caption' => 'Efficiency',
            ],
        ];

        foreach ($steps as $order => $row) {
            AiAdoptionStep::query()->create([
                'ai_adoption_section_id' => $section->id,
                'sort_order' => $order,
                'step_label' => $row['step_label'],
                'title' => $row['title'],
                'description' => $row['description'],
                'style_key' => $row['style_key'],
                'icon_path' => $row['icon_path'],
                'stat_emphasis' => $row['stat_emphasis'] ?? null,
                'stat_caption' => $row['stat_caption'] ?? null,
            ]);
        }

        $checklist = [
            'Unified Threat Intelligence',
            'Zero-Latency Automated Response',
            'Enterprise-Wide Cost Optimization',
        ];

        foreach ($checklist as $order => $label) {
            AiAdoptionChecklistItem::query()->create([
                'ai_adoption_section_id' => $section->id,
                'sort_order' => $order,
                'label' => $label,
            ]);
        }
    }
}
