<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class HeroSection extends Model
{
    protected $fillable = [
        'slug',
        'badge_text',
        'headline_line_1',
        'headline_line_2_lead',
        'headline_line_2_accent',
        'subheadline',
        'background_mode',
        'background_video_path',
        'background_image_path',
        'primary_cta_label',
        'primary_cta_url',
        'primary_cta_icon_path',
        'secondary_cta_label',
        'secondary_cta_url',
        'secondary_cta_icon_path',
        'secondary_cta_show_arrow',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'secondary_cta_show_arrow' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /** @return HasMany<HeroTrustChip, $this> */
    public function trustChips(): HasMany
    {
        return $this->hasMany(HeroTrustChip::class)->orderBy('sort_order');
    }

    /** @return HasMany<HeroStatItem, $this> */
    public function statItems(): HasMany
    {
        return $this->hasMany(HeroStatItem::class)->orderBy('sort_order');
    }

    public function resolvedBackgroundImageUrl(): string
    {
        $path = (string) $this->background_image_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }

    public function resolvedPrimaryCtaIconUrl(): string
    {
        return $this->resolvedOptionalIconPath((string) $this->primary_cta_icon_path);
    }

    public function resolvedSecondaryCtaIconUrl(): string
    {
        return $this->resolvedOptionalIconPath((string) $this->secondary_cta_icon_path);
    }

    private function resolvedOptionalIconPath(string $path): string
    {
        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }

    public function resolvedCtaUrl(string $raw): string
    {
        $raw = trim($raw);
        if ($raw === '') {
            return '#';
        }

        if (Str::startsWith($raw, ['http://', 'https://', '//'])) {
            return $raw;
        }

        return url($raw);
    }

    public function backgroundVideoSrc(): string
    {
        $path = trim((string) $this->background_video_path);
        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }
}
