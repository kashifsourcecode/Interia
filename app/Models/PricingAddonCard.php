<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingAddonCard extends Model
{
    protected $fillable = [
        'pricing_section_id',
        'sort_order',
        'title',
        'icon_path',
        'footer_description',
        'rows',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rows' => 'array',
        ];
    }

    /**
     * @return BelongsTo<PricingSection, $this>
     */
    public function pricingSection(): BelongsTo
    {
        return $this->belongsTo(PricingSection::class);
    }

    public function resolvedIconUrl(): string
    {
        $path = (string) $this->icon_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }

    /**
     * @return list<array{label: string, amount: string, unit: ?string}>
     */
    public function normalizedRows(): array
    {
        $raw = $this->rows ?? [];

        return collect($raw)
            ->map(function (mixed $row): array {
                if (! is_array($row)) {
                    return ['label' => '', 'amount' => '', 'unit' => null];
                }

                $unit = $row['unit'] ?? null;
                $unit = is_string($unit) && $unit !== '' ? $unit : null;

                return [
                    'label' => (string) ($row['label'] ?? ''),
                    'amount' => (string) ($row['amount'] ?? ''),
                    'unit' => $unit,
                ];
            })
            ->filter(fn (array $r): bool => $r['label'] !== '' || $r['amount'] !== '')
            ->values()
            ->all();
    }
}
