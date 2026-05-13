<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndustryCard extends Model
{
    protected $fillable = [
        'industry_section_id',
        'sort_order',
        'mosaic_column',
        'media_position',
        'aspect_preset',
        'title',
        'description',
        'image_path',
        'image_alt',
    ];

    /**
     * @return BelongsTo<IndustrySection, $this>
     */
    public function industrySection(): BelongsTo
    {
        return $this->belongsTo(IndustrySection::class);
    }

    public function resolvedImageUrl(): string
    {
        $path = (string) $this->image_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }

    public function imageFirst(): bool
    {
        return $this->media_position === 'image_first';
    }

    public function isGamingAspect(): bool
    {
        return $this->aspect_preset === 'gaming';
    }

    /**
     * @return list<string>
     */
    public static function mosaicColumnKeys(): array
    {
        return ['left', 'center', 'right'];
    }

    /**
     * @return list<string>
     */
    public static function mediaPositionKeys(): array
    {
        return ['image_first', 'text_first'];
    }

    /**
     * @return list<string>
     */
    public static function aspectPresetKeys(): array
    {
        return ['default', 'gaming'];
    }

    public function cardCssClasses(): string
    {
        $base = 'industry-card reveal';
        if ($this->isGamingAspect()) {
            $base .= ' industry-card--gaming';
        }

        return $base;
    }

    public function revealDelayClass(int $indexWithinColumn): string
    {
        if ($indexWithinColumn <= 0) {
            return '';
        }

        $n = min($indexWithinColumn, 3);

        return ' reveal-delay-'.$n;
    }

    public function mediaWrapperClasses(): string
    {
        $c = 'industry-card-media';
        if ($this->isGamingAspect()) {
            $c .= ' industry-card-media--gaming';
        }

        return $c;
    }
}
