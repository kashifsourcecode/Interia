<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingPlan extends Model
{
    protected $fillable = [
        'pricing_section_id',
        'sort_order',
        'name',
        'tagline',
        'currency_symbol',
        'amount',
        'period',
        'features',
        'cta_label',
        'cta_url',
        'is_featured',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<PricingSection, $this>
     */
    public function pricingSection(): BelongsTo
    {
        return $this->belongsTo(PricingSection::class);
    }

    /**
     * @return list<string>
     */
    public function featureLines(): array
    {
        $raw = $this->features ?? [];

        return collect($raw)
            ->map(function (mixed $row): string {
                if (is_string($row)) {
                    return $row;
                }
                if (is_array($row)) {
                    return (string) ($row['line'] ?? $row['text'] ?? '');
                }

                return '';
            })
            ->filter()
            ->values()
            ->all();
    }

    public function ctaClass(): string
    {
        return $this->is_featured ? 'pricing-cta-filled' : 'pricing-cta-outline';
    }
}
